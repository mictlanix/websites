//AdminController.cs

//Author:
//       Eddy Zavaleta <eddy@mictlanix.org>
//       Eduardo Nieto <enieto@mictlanix.org>

//Copyright (c) 2011 Eddy Zavaleta, Mictlanix and contributors.

//Permission is hereby granted, free of charge, to any person obtaining a copy
//of this software and associated documentation files (the "Software"), to deal
//in the Software without restriction, including without limitation the rights
//to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
//copies of the Software, and to permit persons to whom the Software is
//furnished to do so, subject to the following conditions:

//The above copyright notice and this permission notice shall be included in
//all copies or substantial portions of the Software.

//THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
//IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
//FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
//AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
//LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
//OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
//THE SOFTWARE.


using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.IO;
using System.Web.Mvc;
using System.Drawing;
using Castle.ActiveRecord;
using Mictlanix.WebSites.JMR.Models;
using Mictlanix.WebSites.JMR.Helpers;

namespace Mictlanix.WebSites.JMR.Controllers
{
    public class AdminController : Controller
    {
        //
        // GET: /Admin/

        public ActionResult Index()
        {
            if (!Request.IsAuthenticated ||
                !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            var qry = from x in Product.Queryable
                      select x;
            return View(qry.ToList());
        }

        //
        // GET: /Admin/Details/5

        public ActionResult Details(int id)
        {
            if (!Request.IsAuthenticated ||
               !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            using (new SessionScope())
            {
                Product item = Product.Find(id);

                item.Photos.ToList();

                return View(item);
            }
        }

        //
        // GET: /Admin/Create

        [HttpPost]
        public ActionResult UpdatePhoto(int id, HttpPostedFileBase file)
        {
            var path = string.Format("~/Photos/{0:000000}", id);
            var filename = string.Format("{0}/{1}.jpg", path, Guid.NewGuid());
            
            Photo item = new Photo {
                Product = Product.Find(id),
                Path = filename
            };

            Directory.CreateDirectory(Server.MapPath(path));
            SavePhoto(item.Path, file);
            item.Create();

            return RedirectToAction("Details", new { id = id });
        }

        void SavePhoto(string fileName, HttpPostedFileBase file)
        {
            if (file != null && file.ContentLength > 0)
            {
                var img = System.Drawing.Image.FromStream(file.InputStream);
                img = resizeImage(img, new Size(480, 320));
                img.Save(Server.MapPath(fileName), System.Drawing.Imaging.ImageFormat.Jpeg);
                img.Dispose();
            }
        }

        private static Image resizeImage(Image imgToResize, Size size)
        {
            int sourceWidth = imgToResize.Width;
            int sourceHeight = imgToResize.Height;

            float nPercent = 0;
            float nPercentW = 0;
            float nPercentH = 0;

            nPercentW = ((float)size.Width / (float)sourceWidth);
            nPercentH = ((float)size.Height / (float)sourceHeight);

            if (nPercentH < nPercentW)
                nPercent = nPercentH;
            else
                nPercent = nPercentW;

            int destWidth = (int)(sourceWidth * nPercent);
            int destHeight = (int)(sourceHeight * nPercent);

            Bitmap b = new Bitmap(destWidth, destHeight);
            Graphics g = Graphics.FromImage((Image)b);
            g.InterpolationMode = System.Drawing.Drawing2D.InterpolationMode.HighQualityBicubic;

            g.DrawImage(imgToResize, 0, 0, destWidth, destHeight);
            g.Dispose();

            return (Image)b;
        }

        public ActionResult Create()
        {
            if (!Request.IsAuthenticated ||
               !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            return View();
        } 

        //
        // POST: /Admin/Create

        [HttpPost]
        public ActionResult Create(Product product)
        {
            if (ModelState.IsValid)
            {
                using (var session = new SessionScope())
                {
                    product.CreationTime = DateTime.Now;
                    product.CreateAndFlush();
                }

                System.Diagnostics.Debug.WriteLine("New CashSession [Id = {0}]", product.Id);
            
                return RedirectToAction("Details", new { id = product.Id } );
            }

            return View(product);
        }
        
        //
        // GET: /Admin/Edit/5
 
        public ActionResult Edit(int id)
        {
            if (!Request.IsAuthenticated ||
               !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            Product product = Product.Find(id);

            return View(product);
        }

        //
        // POST: /Admin/Edit/5

        [HttpPost]
        public ActionResult Edit(Product item)
        {
            if (!ModelState.IsValid)
                return View(item);

            var product = Product.Find(item.Id);

            product.Category = item.Category;
            product.Comment = item.Comment;
            product.CreationTime = DateTime.Now;
            product.Description = item.Description;
            product.Hours = item.Hours;
            product.IsActive = item.IsActive;
            product.Make = item.Make;
            product.Model = item.Model;
            product.Price = item.Price;
            product.Serial = item.Serial;
            product.Year = item.Year;

            product.Update();

            return RedirectToAction("Index");
            
        }

        [HttpPost]
        public ActionResult DeletePhoto(int id)
        {
            Photo item;
            int product;

            using (new SessionScope())
            {
                item = Photo.Find(id);
                product = item.Product.Id;
                item.Delete();
            }

            try
            {
                System.IO.File.Delete(Server.MapPath(item.Path));
            }
            catch
            {
            }

            return RedirectToAction("Details", new { id = product });
        }

        //
        // GET: /Admin/Delete/5
 
        public ActionResult Delete(int id)
        {
            if (!Request.IsAuthenticated ||
               !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            Product item = Product.Find(id);
            return View(item);
        }

        //
        // POST: /Admin/Delete/5

        [HttpPost, ActionName("Delete")]
        public ActionResult DeleteConfirmed(int id)
        {
            Product product = Product.Find(id);
            try
            {
                product.Delete();
                return RedirectToAction("Index");
            }
            catch (Exception)
            {
                return View("DeleteUnsuccessful"); 
            }
        }

        public ActionResult DeleteUnsuccessful()
        {
            return View();
        }
    }
}

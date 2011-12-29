// 
// AdminController.cs
// 
// Author:
//   Eddy Zavaleta <eddy@mictlanix.org>
//   Eduardo Nieto <enieto@mictlanix.org>
// 
// Copyright (C) 2011 Eddy Zavaleta, Mictlanix, and contributors.
// 
// Permission is hereby granted, free of charge, to any person obtaining
// a copy of this software and associated documentation files (the
// "Software"), to deal in the Software without restriction, including
// without limitation the rights to use, copy, modify, merge, publish,
// distribute, sublicense, and/or sell copies of the Software, and to
// permit persons to whom the Software is furnished to do so, subject to
// the following conditions:
// 
// The above copyright notice and this permission notice shall be
// included in all copies or substantial portions of the Software.
// 
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
// EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF
// MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
// NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE
// LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION
// OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION
// WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
//

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
                Product item = Product.Find (id);

                item.Photos.ToList ();

                return View(item);
            }
        }

        //
        // GET: /Admin/Create

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
        public ActionResult Create (Product item)
		{
			if (ModelState.IsValid) {
				using (var session = new SessionScope()) {
					if (item.Make != MakeEnum.Other) {
						item.MakeName = item.Make.GetDisplayName ();
					}
					item.CreationTime = DateTime.Now;
					item.CreateAndFlush ();
				}

				System.Diagnostics.Debug.WriteLine ("New CashSession [Id = {0}]", item.Id);
            
				return RedirectToAction ("Details", new { id = item.Id });
			}

			return View (item);
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
        public ActionResult Edit (Product item)
		{
			if (!ModelState.IsValid)
				return View (item);
			
			if (item.Make != MakeEnum.Other) {
				item.MakeName = item.Make.GetDisplayName ();
			}
			
			var product = Product.Find (item.Id);

			product.Category = item.Category;
			product.Comment = item.Comment;
			product.CreationTime = DateTime.Now;
			product.Description = item.Description;
			product.Hours = item.Hours;
			product.IsActive = item.IsActive;
			product.Make = item.Make;
			product.MakeName = item.MakeName;
			product.Model = item.Model;
			product.Price = item.Price;
			product.Serial = item.Serial;
			product.Year = item.Year;

			product.Update ();

			return RedirectToAction ("Index");
		}

		[HttpPost]
		public ActionResult UploadPhoto (int id, HttpPostedFileBase file)
		{
			var path = string.Format ("~/Photos/{0:000000}", id);
			var filename = string.Format ("{0}/{1}.jpg", path, Guid.NewGuid ());
            
			if (file == null || !file.ContentType.StartsWith ("image")) {
				Product item;
				ModelState.AddModelError ("", "Archivo inválido, no es una imagen.");
				using (var session = new SessionScope()) {
					item = Product.TryFind (id);
					item.Photos.ToList ();
				}
				return View ("Details", item);
			}
			
			Photo photo = new Photo {
                Product = Product.TryFind (id),
                Path = filename
            };

			SavePhotoAsJpeg (photo.Path, file);
			photo.Create ();

			return RedirectToAction ("Details", new { id = id });
		}
		
        [HttpPost]
        public ActionResult DeletePhoto (int id)
		{
			Photo item;
			int product;

			using (new SessionScope()) {
				item = Photo.Find (id);
				product = item.Product.Id;
				item.Delete ();
			}
			
			DeletePhoto (item.Path);

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

        public ActionResult DeleteUnsuccessful ()
		{
			return View ();
		}
		
		void SavePhotoAsJpeg (string fileName, HttpPostedFileBase file)
		{
			if (file == null || file.ContentLength == 0)
				return;
			
			var path = Path.GetDirectoryName (Server.MapPath (fileName));
			var name = Path.GetFileName (fileName);
			var img = System.Drawing.Image.FromStream (file.InputStream);
			
			Directory.CreateDirectory (path);
			Directory.CreateDirectory (Path.Combine (path, "orginals"));
			
			img.Save (Path.Combine (path, "orginals", name),
			          System.Drawing.Imaging.ImageFormat.Jpeg);
			
			img = ResizeImage (img, new Size (480, 320));
			img.Save (Path.Combine (path, name),
			          System.Drawing.Imaging.ImageFormat.Jpeg);
			
			img.Dispose ();
		}
		
		void DeletePhoto (string fileName)
		{
			var path = Path.GetDirectoryName (Server.MapPath (fileName));
			var name = Path.GetFileName (fileName);
			
			try {
				System.IO.File.Delete (Path.Combine (path, name));
				System.IO.File.Delete (Path.Combine (path, "orginals", name)); 
			} catch {
			}
		}
		
		Image ResizeImage (Image image, Size size)
		{
			int src_width = image.Width;
			int src_height = image.Height;

			float ratio = 0;
			float width_ratio = 0;
			float height_ratio = 0;

			width_ratio = ((float)size.Width / (float)src_width);
			height_ratio = ((float)size.Height / (float)src_height);

			if (height_ratio < width_ratio)
				ratio = height_ratio;
			else
				ratio = width_ratio;

			int dest_width = (int)(src_width * ratio);
			int dest_height = (int)(src_height * ratio);

			Bitmap b = new Bitmap (dest_width, dest_height);
			Graphics g = Graphics.FromImage ((Image)b);
			g.InterpolationMode = System.Drawing.Drawing2D.InterpolationMode.HighQualityBicubic;

			g.DrawImage (image, 0, 0, dest_width, dest_height);
			g.Dispose ();

			return (Image)b;
		}
    }
}

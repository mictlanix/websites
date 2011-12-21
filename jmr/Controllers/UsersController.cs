//UsersController.cs

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
using System.Data;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using Mictlanix.WebSites.JMR.Models;
using Mictlanix.WebSites.JMR.Helpers;

namespace Mictlanix.WebSites.JMR.Controllers
{
    public class UsersController : Controller
    {
        //
        // GET: /Users/

        public ActionResult Index()
        {
            if (!Request.IsAuthenticated ||
                !SecurityHelpers.GetUser(User.Identity.Name).IsAdministrator)
            {
                return RedirectToAction("LogOn", "Account");
            }

            var qry = from x in Models.User.Queryable
                      select x;

            return View(qry.ToList());
        }

        //
        // GET: /Users/Details/5

        public ViewResult Details(string id)
        {
            User user = Models.User.Find(id);
            return View(user);
        }

        //
        // GET: /Users/Edit/5

        public ActionResult Edit(string id)
        {
            User user = Models.User.Find(id);
            return View(user);
        }

        //
        // POST: /Users/Edit/5

        [HttpPost]
        public ActionResult Edit(User item)
        {
            if (!ModelState.IsValid)
            {
                return View(item);
            }

            User user = Models.User.Find(item.UserName);

            user.Email = item.Email;
            user.IsAdministrator = item.IsAdministrator;

            user.Update();

            return RedirectToAction("Index");

        }

        //
        // GET: /Users/Delete/5

        public ActionResult Delete(string id)
        {
            User item = Models.User.Find(id);
            return View(item);
        }

        //
        // POST: /Users/Delete/5

        [HttpPost, ActionName("Delete")]
        public ActionResult DeleteConfirmed(string id)
        {
            User item = Models.User.Find(id);

            item.Delete();

            return RedirectToAction("Index");
        }
    }
}

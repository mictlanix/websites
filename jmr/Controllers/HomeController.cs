// 
// HomeController.cs
// 
// Author:
//   Eddy Zavaleta <eddy@mictlanix.org>
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
using System.Web.Mvc;
using Castle.ActiveRecord;
using Mictlanix.WebSites.JMR.Models;
using Mictlanix.WebSites.JMR.Properties;

namespace Mictlanix.WebSites.JMR.Controllers
{
    public class HomeController : Controller
    {
		Random rand = new Random ();
		
        //
        // GET: /Home/

        public ActionResult Index ()
		{
			var items = new List<EquipmentItem> (8); 
			var qry = from x in Product.Queryable
					  where x.IsActive
					  select new { Id = x.Id };
			
			foreach (var i in qry.ToList ().OrderBy (x => rand.Next ()).Take (8)) {
				using (new SessionScope()) {
					var item = Product.Find (i.Id);
					var photo = item.Photos.OrderBy (x => rand.Next ()).FirstOrDefault () ?? new Photo { Path = Resources.DefaultPhoto };
					items.Add (new EquipmentItem {
						Id = item.Id,
						Category = item.Category,
						MakeName = item.MakeName,
						Model = item.Model,
						Price = item.Price,
						Path = photo.Path,
					});
				}
			}
			
			return View (items);
		}
		
		public ActionResult Sitemap ()
		{
			return View ();
		}
    }
}

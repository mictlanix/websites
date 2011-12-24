// 
// EquipmentController.cs
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

namespace Mictlanix.WebSites.JMR.Controllers
{
    public class EquipmentController : Controller
    {
        //
        // GET: /Products/

        public ActionResult Index()
        {
            return View();
        }
		
		public ActionResult Browse (string category)
		{
			Product master;
			CategoryEnum item;
			
			if (!CategoryEnum.TryParse (category, true, out item) ||
			    !Enum.IsDefined (typeof(CategoryEnum), item)) {
				return RedirectToAction ("Index");
			}
			
			var qry = from x in Product.Queryable
					  where x.IsActive && x.Category == item
                      select new EquipmentItem { Id = x.Id, Make = x.Make, Model = x.Model, Price = x.Price };
			
			var list = qry.ToList ();
			
			if (list.Count == 0) {
				return View (new MasterDetails<Product, EquipmentItem> {
					Master = new Product { Category = item },
					Details = list
				});
			}
			
			foreach (var equipment in list) {
				Photo photo = Photo.Queryable.Where (x => x.Product.Id == equipment.Id).FirstOrDefault ();
				
				if (photo != null)
					equipment.Path = photo.Path;
			}
			
			using (new SessionScope()) {
				master = Product.TryFind (list.First ().Id);
				master.Photos.ToList ();
			}
			
			return View (new MasterDetails<Product, EquipmentItem> {
				Master = master,
				Details = list
			});
		}
		
		public ActionResult Specs (int equipment)
		{
			Product item = null;
			
			using (new SessionScope()) {
				item = Product.TryFind (equipment);
				
				if (item == null) {
					if (Request.IsAjaxRequest ()) {
						return PartialView ("Error");
					}
					
					return RedirectToAction ("Index");
				}
				
				item.Photos.ToList ();
			}
			
			if (Request.IsAjaxRequest ()) {
				return PartialView ("_Specs", item);
			}
			
			return View (item);
		}
    }
}

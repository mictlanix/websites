/*
ContactController.cs

Author:
       Eddy Zavaleta <eddy@mictlanix.org>

Copyright (c) 2011 Eddy Zavaleta, Mictlanix and contributors.

Permission is hereby granted, free of charge, to any person obtaining a copy
of this software and associated documentation files (the "Software"), to deal
in the Software without restriction, including without limitation the rights
to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the Software is
furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in
all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
THE SOFTWARE.
*/
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net;
using System.Net.Mail;
using System.Web;
using System.Web.Mvc;
using System.Text.RegularExpressions;
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
			CategoryEnum item;
			
			if (!CategoryEnum.TryParse (category, true, out item) ||
			    !Enum.IsDefined (typeof(CategoryEnum), item)) {
				return RedirectToAction ("Index");
			}
			
			return View (item);
		}
		
		public ActionResult Specs (int equipment)
		{
			CategoryEnum category = CategoryEnum.Excavators;
			
			if (equipment == 0) {
				return RedirectToAction ("Index");
			}
			
			return View (category);
		}
    }
}
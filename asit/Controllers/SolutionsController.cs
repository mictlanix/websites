/*
SolutionsController.cs

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
using System.Web;
using System.Web.Mvc;

namespace Mictlanix.WebSites.Asit.Controllers
{
    public class SolutionsController : Controller
    {
		static readonly string[] storage_items = {
			"Provitioning",
			"FlashCopy",
			"Migration",
			"Mirroring",
			"EasyTier",
			"Director",
			"Tivoli",
			"Virtualization"
		};
		
		static readonly string[] software_items = {
			"Availability",
			"Clusters",
			"DataGuard",
			"Fusion",
			"Performance",
			"Partitioning",
			"Cache",
			"TimesTen",
			"Compression",
			"Management",
			"Applications",
			"LifeCycle",
			"ServiceLevel",
			"Settings"
		};
		
		static readonly string[] servers_items = {
			"ActiveMemory",
			"Availability",
			"Cache",
			"Director",
			"EnergyScale",
			"GPFS",
			"Management",
			"MicroPartitioning",
			"Performance",
			"PowerHA",
			"PowerVM",
			"Threading",
			"TurboCore"
		};
		
        //
        // GET: /Solutions/

        public ActionResult Index()
        {
            return View();
        }
		
        //
        // GET: /Solutions/Storage
		
        public ActionResult Storage(string id)
        {
			if (Request.IsAjaxRequest())
			{
				if(storage_items.Contains(id))
				{
					return PartialView(string.Format("Storage/{0}", id));
				}
				else
				{
					return View("Error");
				}
			}
			
            return View();
        }
		
        //
        // GET: /Solutions/Software
		
        public ActionResult Software(string id)
        {
			if (Request.IsAjaxRequest())
			{
				if(software_items.Contains(id))
				{
					return PartialView(string.Format("Software/{0}", id));
				}
				else
				{
					return View("Error");
				}
			}
			
            return View();
        }
		
        //
        // GET: /Solutions/Servers
		
        public ActionResult Servers(string id)
        {
			if (Request.IsAjaxRequest())
			{
				if(servers_items.Contains(id))
				{
					return PartialView(string.Format("Servers/{0}", id));
				}
				else
				{
					return View("Error");
				}
			}
			
            return View();
        }
    }
}

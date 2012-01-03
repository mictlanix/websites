// 
// ContactController.cs
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
using System.Net;
using System.Net.Mail;
using System.Web;
using System.Web.Mvc;
using System.Text.RegularExpressions;
using Mictlanix.WebSites.JMR.Models;

namespace Mictlanix.WebSites.JMR.Controllers
{
    public class ContactController : Controller
    {
        // This regex pattern came from: 
        // http://haacked.com/archive/2007/08/21/i-knew-how-to-validate-an-email-address-until-i.aspx
        static readonly Regex REGEX_EMAIL = new Regex(@"^(?!\.)(""([^""\r\\]|\\[""\r\\])*""|([-a-z0-9!#$%&'*+/=?^_`{|}~]|(?<!\.)\.)*)(?<!\.)@[a-z0-9][\w\.-]*[a-z0-9]\.[a-z][a-z\.]*[a-z]$", RegexOptions.Compiled | RegexOptions.IgnoreCase);
        
        //
        // GET: /Contact/

        public ActionResult Index()
        {
            return View(new ContactUs { To = "df"});
        }
		
        //
        // POST: /Contact/
		
		[HttpPost]
        public ActionResult Index (ContactUs input)
		{
			if (!IsValidEmailAddress (input.Email)) {
				ModelState.AddModelError ("Email", "No es una dirección de email válida.");
			}
			
			if (ModelState.IsValid) {
				MailAddress to;
				MailAddress[] cc = new MailAddress [2];
				MailAddress from = new MailAddress (input.Email, input.Name);
				string subject = string.Format ("[{0}] Sitio Web - Contacto", input.To.ToUpper ());
				
				cc [0] = new MailAddress ("info@jmrmaquinaria.mx", "JMR Máquinaria");
				
				switch (input.To.ToUpper ()) {
				case "PUEBLA":
					to = new MailAddress ("jsanchez@jmrmaquinaria.mx", "Jesús Sánchez");
					cc [1] = new MailAddress ("jmajesus@hotmail.com", "Jesús Sánchez");
					break;
				case "TUXTLA":
					to = new MailAddress ("jromero@jmrmaquinaria.mx", "Juan Romero");
					cc [1] = new MailAddress ("delsurestemaquinaria@hotmail.com", "Juan Romero");
					break;
				default:
					to = new MailAddress ("jalcantar@jmrmaquinaria.mx", "Jair Alcantar");
					cc [1] = new MailAddress ("jmadario@hotmail.com", "Rubén Perera");
					break;
				}
				
				SendEmail (from, to, cc, subject, input.ToString ());
				return PartialView ("_Success", new ContactUs { IsSent = true });
			}
			
			return PartialView ("_Form", input);
		}
		
		bool SendEmail (MailAddress addrFrom, MailAddress addrTo, MailAddress[] addrCC,
		                string subject, string body)
		{
			var smtp = new SmtpClient ("localhost");
			
			try {
				using (var message = new MailMessage(addrFrom, addrTo)) {
					foreach (var cc in addrCC) {
						message.CC.Add (cc);
					}
					message.Subject = subject;
					message.Body = body;
					smtp.Send (message);
				}
				
				return true;
			} catch (Exception e) {
				System.Diagnostics.Debug.WriteLine (e);
			}
			
			return false;
		}

        public static bool IsValidEmailAddress(string str)
        {
            if (IsStringMissing(str))
                return false;

            return REGEX_EMAIL.IsMatch(str);
        }

        public static bool IsStringMissing(string value)
        {
            return value == null || value.Trim().Length == 0;
        }
    }
}

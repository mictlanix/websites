using System;
using System.Configuration;
using System.Collections.Generic;
using System.Globalization;
using System.Linq;
using System.Web;
using System.Web.Mvc;
using System.Web.Routing;
using System.Threading;
using Castle.ActiveRecord;
using Castle.ActiveRecord.Framework;
using Mictlanix.WebSites.JMR.Models;

namespace Mictlanix.WebSites.JMR
{
    public class MvcApplication : System.Web.HttpApplication
    {
        public static void RegisterGlobalFilters(GlobalFilterCollection filters)
        {
            filters.Add(new HandleErrorAttribute());
        }

        public static void RegisterRoutes (RouteCollection routes)
		{
			routes.IgnoreRoute ("{resource}.axd/{*pathInfo}");
			
			routes.MapRoute (
                "Specifications",
                "Equipment/Specs/{equipment}",
                new { controller = "Equipment", action = "Specs", equipment = @"\d+" }
            );
			
			routes.MapRoute (
                "Equipment",
                "Equipment/{category}",
                new { controller = "Equipment", action = "Browse" }
            );
			
			routes.MapRoute (
                "Default",
                "{controller}/{action}/{id}",
                new { controller = "Home", action = "Index", id = UrlParameter.Optional }
            );
		}

        protected void Application_Start ()
		{
			AreaRegistration.RegisterAllAreas ();

			RegisterGlobalFilters (GlobalFilters.Filters);
			RegisterRoutes (RouteTable.Routes);

			IConfigurationSource source = ConfigurationManager.GetSection ("activeRecord") as IConfigurationSource;
			ActiveRecordStarter.Initialize (typeof(Product).Assembly, source);
			
		}
		
		protected void Application_BeginRequest (object sender, EventArgs e)
		{
			CultureInfo culture = new System.Globalization.CultureInfo ("es-MX");
			culture.NumberFormat.CurrencySymbol = "USD $";
			Thread.CurrentThread.CurrentCulture = culture;
		}
		
		protected void Application_EndRequest (Object sender, EventArgs e)
		{
			HttpContext.Current.Items.Remove ("CurrentUser");
		}
    }
}
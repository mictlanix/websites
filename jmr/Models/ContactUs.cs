using System;
using System.ComponentModel.DataAnnotations;

namespace Mictlanix.WebSites.JMR.Models
{
	public class ContactUs
	{
		public override string ToString ()
		{
			return string.Format ("Nombre: {0}\nEmail: {1}\nEmpresa: {2}\nTeléfono: {3}\nComentario:{4}", Name, Email, Company, Phone, Comment);
		}
		
        [Required(ErrorMessage = "El nombre es obligatorio.")]
        public string Name { get; set; }
		
        [Required(ErrorMessage = "El email es obligatorio.")]
        public string Email { get; set; }
		
        public string Company { get; set; }
        public string Phone { get; set; }
        [DataType(DataType.MultilineText)]
        public string Comment { get; set; }
		
        public bool IsSent { get; set; }
	}
}
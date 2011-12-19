using System;
using System.ComponentModel.DataAnnotations;

namespace Mictlanix.WebSites.JMR.Models
{
	public class ContactUs
	{
		public override string ToString ()
		{
			return string.Format ("Nombre: {0}\nEmail: {1}\nComentario:\n{2}", Name, Email, Comment);
		}
		
        [Required(ErrorMessage = "El nombre es obligatorio.")]
        public string Name { get; set; }
		
        [Required(ErrorMessage = "El email es obligatorio.")]
        public string Email { get; set; }
		
        [DataType(DataType.MultilineText)]
        public string Comment { get; set; }
		
        public string To { get; set; }
        public bool IsSent { get; set; }
	}
}
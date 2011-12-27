//
// Product.cs
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
using System.ComponentModel.DataAnnotations;
using Castle.ActiveRecord;
using Castle.ActiveRecord.Framework;
using Mictlanix.WebSites.JMR.Properties;

namespace Mictlanix.WebSites.JMR.Models
{
    [ActiveRecord("product")]
    public class Product : ActiveRecordLinqBase<Product>
    {
        IList<Photo> photos = new List<Photo>();

        [PrimaryKey(PrimaryKeyType.Identity, "product_id")]
        public int Id { get; set; }

        [Property]
        [Display(Name = "Category", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        public CategoryEnum Category { get; set; }

        [Property]
        [Display(Name = "Make", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        public MakeEnum Make { get; set; }

        [Property]
        [Display(Name = "Model", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        [StringLength(50, MinimumLength = 2, ErrorMessageResourceName = "Validation_StringLength", ErrorMessageResourceType = typeof(Resources))]
        public string Model { get; set; }

        [Property]
        [Display(Name = "Year", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        public int Year { get; set; }

        [Property]
        [Display(Name = "Hours", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        [StringLength(25, MinimumLength = 1, ErrorMessageResourceName = "Validation_StringLength", ErrorMessageResourceType = typeof(Resources))]
        public string Hours { get; set; }

        [Property]
        [DataType(DataType.MultilineText)]
        [Display(Name = "Description", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        [StringLength(8000, MinimumLength = 5, ErrorMessageResourceName = "Validation_StringLength", ErrorMessageResourceType = typeof(Resources))]
        public string Description { get; set; }

        [Property]
        [Display(Name = "Serial", ResourceType = typeof(Resources))]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        [StringLength(50, MinimumLength = 1, ErrorMessageResourceName = "Validation_StringLength", ErrorMessageResourceType = typeof(Resources))]
        public string Serial { get; set; }

        [Property("active")]
        [Display(Name = "Active", ResourceType = typeof(Resources))]
        public bool IsActive { get; set; }

        [Property]
        [DataType(DataType.MultilineText)]
        [Display(Name = "Comment", ResourceType = typeof(Resources))]
        [StringLength(8000, MinimumLength = 5, ErrorMessageResourceName = "Validation_StringLength", ErrorMessageResourceType = typeof(Resources))]
        public string Comment { get; set; }

        [Property]
        [Display(Name = "Price", ResourceType = typeof(Resources))]
        [DataType(DataType.Currency)]
        [Required(ErrorMessageResourceName = "Validation_Required", ErrorMessageResourceType = typeof(Resources))]
        public decimal Price { get; set; }

        [Property("creation_time")]
        [DataType(DataType.Date)]
        [Display(Name = "CreationTime", ResourceType = typeof(Resources))]
        public DateTime CreationTime { get; set; }

        [HasMany(typeof(Photo), Table = "photo", ColumnKey = "product", Lazy = true)]
        public IList<Photo> Photos {
			get { return photos; }
			set { photos = value; }
		}
		
		public string Group { get; set; }
  
		#region Override Base Methods

        public override string ToString()
        {
            return string.Format("{0} [{1}, {2}, {3}]", Category, Make, Model, Year);
        }

        public override bool Equals(object obj)
        {
            Product other = obj as Product;

            if (other == null)
                return false;

            if (Id == 0 && other.Id == 0)
                return (object)this == other;
            else
                return Id == other.Id;
        }

        public override int GetHashCode()
        {
            if (Id == 0)
                return base.GetHashCode();

            return string.Format("{0}#{1}", GetType().FullName, Id).GetHashCode();
        }

        #endregion
    }
}
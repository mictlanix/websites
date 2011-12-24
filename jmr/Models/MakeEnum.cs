// 
// MakeEnum.cs
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
using System.ComponentModel.DataAnnotations;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using Mictlanix.WebSites.JMR.Properties;

namespace Mictlanix.WebSites.JMR.Models
{
    public enum MakeEnum : int
    {
        [Display(Name = "CAT", ResourceType = typeof(Resources))]
        CAT = 1,
        [Display(Name = "CASE", ResourceType = typeof(Resources))]
        CASE,
        [Display(Name = "Komatsu", ResourceType = typeof(Resources))]
        Komatsu,
        [Display(Name = "JohnDeere", ResourceType = typeof(Resources))]
        JohnDeere,
        [Display(Name = "Volvo", ResourceType = typeof(Resources))]
        Volvo,
        [Display(Name = "JCB", ResourceType = typeof(Resources))]
        JCB
    }
}
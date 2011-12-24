// 
// CategoryEnum.cs
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
    public enum CategoryEnum : int
    {
        [Display(Name = "Excavators", ResourceType = typeof(Resources))]
        Excavators = 1,
        [Display(Name = "Backhoes", ResourceType = typeof(Resources))]
        BackhoeLoaders,
        [Display(Name = "MotorGraders", ResourceType = typeof(Resources))]
        MotorGraders,
        [Display(Name = "VibroCompactors", ResourceType = typeof(Resources))]
        VibroCompactors,
        [Display(Name = "Tractors", ResourceType = typeof(Resources))]
        Tractors,
        [Display(Name = "AsphaltEquipment", ResourceType = typeof(Resources))]
        AsphaltEquipment,
        [Display(Name = "FrontLoaders", ResourceType = typeof(Resources))]
        FrontLoaders,
        [Display(Name = "Cranes", ResourceType = typeof(Resources))]
        Cranes,
        [Display(Name = "Others", ResourceType = typeof(Resources))]
        Others
    }
}
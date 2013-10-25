//
// Program.cs
//
// Author:
//       Eddy Zavaleta <eddy@mictlanix.com>
//
// Copyright (c) 2013 Eddy Zavaleta, Mictlanix, and contributors.
//
// Permission is hereby granted, free of charge, to any person obtaining a copy
// of this software and associated documentation files (the "Software"), to deal
// in the Software without restriction, including without limitation the rights
// to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
// copies of the Software, and to permit persons to whom the Software is
// furnished to do so, subject to the following conditions:
//
// The above copyright notice and this permission notice shall be included in
// all copies or substantial portions of the Software.
//
// THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
// IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
// FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
// AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
// LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
// OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
// THE SOFTWARE.
using System;
using System.Configuration;
using System.IO;
using System.Linq;

namespace WebSiteBlocker
{
	class Program
	{
		static string COMMENT = "Mictlanix's Web Site Blocker";

		public static void Main (string[] args)
		{
			string ip = ConfigurationManager.AppSettings ["IP"];
			string hosts_file = ConfigurationManager.AppSettings ["HostsFile"];
			string black_list_file = ConfigurationManager.AppSettings ["BlackListFile"];

			string[] hosts = File.ReadAllLines (hosts_file);
			string[] black_list = File.ReadAllLines (black_list_file);

			try {
				using (StreamWriter outfile = new StreamWriter (hosts_file)) {
					foreach (var line in hosts) {
						if (!line.Contains (COMMENT) && black_list.Count (x => line.Contains (x)) == 0) {
							outfile.WriteLine (line);
						}
					}

					outfile.WriteLine ("### BEGIN {0}", COMMENT);

					foreach (var line in black_list) {
						outfile.WriteLine ("{0} {1} # {2}", ip, line.PadRight(48), COMMENT);
					}

					outfile.WriteLine ("### END {0}", COMMENT);
				}
				Console.WriteLine ("Done!");
			} catch(UnauthorizedAccessException) {
				Console.Error.WriteLine ("Admin Access Requiered!");
			}
		}
	}
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Herbergi_generator
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            int teljari = 0, hotelID = 0;
            string[] herbergi = new string[1000];
            for (int i = 0; i < herbergi.Length; i++)
            {
                herbergi[i] += "(";
                if (teljari<=4)
                {
                    herbergi[i] += "1," + hotelID.ToString() + "),\n";
                }
                else if (teljari>=5 && teljari<=7)
                {
                    herbergi[i] += "2," + hotelID.ToString() + "),\n";
                }
                else if (teljari>=8 && teljari<=58)
                {
                    herbergi[i] += "3," + hotelID.ToString() + "),\n";
                }
                else if (teljari>=59 && teljari<=60)
                {
                    herbergi[i] += "4," + hotelID.ToString() + "),\n";
                }
                else if (teljari>=61 && teljari<=63)
                {
                    herbergi[i] += "5," + hotelID.ToString() + "),\n";
                }
                else
                {
                    herbergi[i] += "6," + hotelID.ToString() +"),\n";
                }
                if (teljari==100)
                {
                    teljari = 0;
                    hotelID++;
                }
                teljari++;
            }//lokar for
            for (int i = 0; i < herbergi.Length; i++)//skrifar allt út
            {
                richTextBox1.Text += herbergi[i];
            }
        }
    }
}

using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace Bokanir_Generator
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }
        private void button1_Click(object sender, EventArgs e)
        {
            richTextBox1.Text = null;
            int hotelnumer = 0;
            int fjoldi = Convert.ToInt32(textBox1.Text);
            string[] bokun = new string[fjoldi];
            Random rand = new Random();
            int tala=0, teljari=1;
            int[]komuar=new int[fjoldi], komuman=new int[fjoldi], komudagur=new int[fjoldi];
            int[]farar=new int[fjoldi], farman=new int[fjoldi], fardagur=new int[fjoldi];

            for (int i = 0; i < bokun.Length; i++)//notandi_ID
            {
                bokun[i]+="(";
                tala=rand.Next(1,151);
                bokun[i] += tala.ToString()+",";
            }
            for (int i = 0; i < bokun.Length; i++)//herbergi_ID
			{
                if (comboBox1.Text == "1. Hótel Stykkishólmur")
                {
                    tala = 1;
                    bokun[i] += tala.ToString() + ",";
                    tala=rand.Next(1,151);
                    bokun[i]+=tala.ToString()+",";
                }
                if (comboBox1.Text == "2. Hótel Ísafjörður")
                {
                    hotelnumer = 2;
                    tala = 2;
                    bokun[i] += tala.ToString()+",";
                    tala=rand.Next(151, 301);
                    bokun[i]+=tala.ToString()+",";
                }
                if (comboBox1.Text == "3. Hótel Blöndós")
                {
                    hotelnumer = 3;
                    tala = 3;
                    bokun[i] += tala.ToString()+",";
                    tala=rand.Next(301, 451);
                    bokun[i]+=tala.ToString()+",";
                }
                if(comboBox1.Text=="4. Hótel Sauðárkrókur")
                {
                    hotelnumer = 4;
                    tala = 4;
                    bokun[i] += tala.ToString()+",";
                    tala=rand.Next(451,601);
                    bokun[i]+=tala.ToString()+",";
                }
                if (comboBox1.Text == "5. Hótel Akureyri")
                {
                    hotelnumer = 5;
                    tala = 5;
                    bokun[i] += tala.ToString()+",";
                    tala=rand.Next(601, 751);
                    bokun[i]+=tala.ToString()+",";
                }
                if (comboBox1.Text=="6. Hótel Húsavík")
                {
                    hotelnumer = 6;
                    tala = 6;
                    bokun[i] += tala.ToString()+",";
                    tala = rand.Next(751, 901);
                    bokun[i] += tala.ToString() + ",";
                }
                if (comboBox1.Text=="7. Hótel Egillsstaðir")
                {
                    hotelnumer = 7;
                    tala = 7;
                    bokun[i] += tala.ToString()+",";
                    tala = rand.Next(901, 1051);
                    bokun[i] += tala.ToString() + ",";
                }
                if(comboBox1.Text=="8. Hótel Selfoss")
                {
                    hotelnumer = 8;
                    tala = 8;
                    bokun[i] += tala.ToString()+",";
                    tala = rand.Next(1051, 1201);
                    bokun[i] += tala.ToString() + ",";
                }
                if (comboBox1.Text=="9. Hótel Vestmaneyjar")
                {
                    hotelnumer = 9;
                    tala = 9;
                    bokun[i] += tala.ToString()+",";
                    tala = rand.Next(1201, 1351);
                    bokun[i] += tala.ToString() + ",";
                }
                if (comboBox1.Text=="10. Hótel Reykjavík")
                {
                    hotelnumer = 10;
                    tala = 10;
                    bokun[i] += tala.ToString()+",";
                    tala = rand.Next(1351, 1501);
                    bokun[i] += tala.ToString() + ",";
                }
            }
            for (int i = 0; i < bokun.Length; i++)//komudagur(ár)
            {
                tala=rand.Next(2010, 2021);
                komuar[i]=tala;
                farar[i] = tala;
            }
            for (int i = 0; i < bokun.Length; i++)//komudagur(mánuður)
            {
                tala=rand.Next(1,13);
                komuman[i]=tala;
                farman[i] = tala;
            }
            for (int i = 0; i < bokun.Length; i++)//komudagur(dagur)
            {
                tala=rand.Next(1,29);
                komudagur[i]=tala;
                fardagur[i] = tala;
            }
            for (int i = 0; i < bokun.Length; i++)
            {
                tala=rand.Next(1,22);
                fardagur[i]=komudagur[i]+tala;
                if(fardagur[i]>=29){
                    fardagur[i]=fardagur[i]-28;
                    farman[i]++;
                }
                if(farman[i]>=13){
                    farman [i]=farman[i]-12;
                    farar[i]++;
                }
            }
            for (int i = 0; i < bokun.Length; i++)
            {
                bokun[i]+= "'"+komuar[i]+"-"+komuman[i]+"-"+komudagur[i]+"',";
            }

            for (int i = 0; i < bokun.Length; i++)
            {
                bokun[i]+="'"+farar[i]+"-"+farman[i]+"-"+fardagur[i]+"'),";
            }
            for (int i = 0; i < bokun.Length; i++)
            {
                richTextBox1.Text+=bokun[i].ToString()+"\n";
            }
        }
    }
}

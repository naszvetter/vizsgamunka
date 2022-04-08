using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace s_port
{
    public partial class Belepes : Form
    {
        public Belepes()
        {
            InitializeComponent();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            if (textBox1.Text == "S-port" && textBox2.Text == "S-port")
            {
                new Form1().Show();
                Hide();
            }
            else
            {
                MessageBox.Show("Hibás felhasználónév vagy jelszó!", "Hiba");
            }
        }
        private void BelepesEnterre(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                button1_Click(null, null);
                e.SuppressKeyPress = true;
            }
        }
    }
}

using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Drawing;
using System.Windows.Forms;

namespace s_port
{
    public partial class Hozzaadas : Form
    {
        private string _tabla;
        private DataColumnCollection _oszlopok;

        public Hozzaadas(string tabla, DataColumnCollection oszlopok)
        {
            InitializeComponent();

            _tabla = tabla;
            _oszlopok = oszlopok;

            for (int i = 0; i < oszlopok.Count; i++)
            {
                tableLayoutPanel1.RowCount = tableLayoutPanel1.RowCount + 1;
                tableLayoutPanel1.RowStyles.Add(new RowStyle(SizeType.Absolute, 30F));
                tableLayoutPanel1.Controls.Add(new Label() { Text = oszlopok[i].ColumnName, ForeColor = Color.White }, 0, tableLayoutPanel1.RowCount - 1);
                var textBox = new TextBox();
                textBox.KeyDown += TextBox_KeyDown;
                tableLayoutPanel1.Controls.Add(textBox,1, tableLayoutPanel1.RowCount - 1);
            }

            var hozzaadasGomb = new Button() { Text = "Hozzáadás" };
            hozzaadasGomb.Click += HozzaadasGomb_Click;
            tableLayoutPanel1.RowCount = tableLayoutPanel1.RowCount + 1;
            tableLayoutPanel1.Controls.Add(hozzaadasGomb, 1, tableLayoutPanel1.RowCount - 1);
        }

        private void TextBox_KeyDown(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                HozzaadasGomb_Click(null, null);
                e.SuppressKeyPress = true;
            }
        }
        private void HozzaadasGomb_Click(object sender, EventArgs e)
        {
            var parancs = ParancsLetrehozasa();

            try
            {
                using (MySqlConnection con = new MySqlConnection("datasource=localhost;port=3306;username=root;password="))
                {
                    con.Open();
                    using (MySqlCommand command = new MySqlCommand(parancs, con))
                    {
                        command.ExecuteNonQuery();
                    }
                    con.Close();
                }

                DialogResult = DialogResult.OK;
                Close();
            }
            catch (Exception ex)
            {
                MessageBox.Show("Hiba történt a hozzáadásnál! Próbálja újra!", caption: "Hiba");
            }
        }

        private string ParancsLetrehozasa()
        {
            string parancs = $"INSERT INTO sport_esemenyek.`{_tabla}` (";

            for (int i = 0; i < _oszlopok.Count; i++)
            {
                parancs += $"`{_oszlopok[i].ColumnName}`,";
            }

            parancs = parancs.Remove(parancs.Length - 1, 1);
            parancs += ") VALUES (";


            foreach (var control in tableLayoutPanel1.Controls)
            {
                if (control is TextBox)
                {
                    var textBox = control as TextBox;

                    if (int.TryParse(textBox.Text, out _))
                    {
                        parancs += $"{textBox.Text},";
                    }
                    else
                    {
                        parancs += $"'{textBox.Text}',";
                    }
                }
            }

            parancs = parancs.Remove(parancs.Length - 1, 1);
            parancs += ");";

            return parancs;
        }
    }
}

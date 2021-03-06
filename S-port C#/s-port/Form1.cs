using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Windows.Forms;

namespace s_port
{
    public partial class Form1 : Form
    {
        private readonly string _connectionString = "datasource=localhost;port=3306;username=root;password=";
        private DataTable _aktualisTabla;
        private string _aktualisTablaNeve;
        public Form1()
        {
            InitializeComponent();
            Icon = s_port.Properties.Resources.ikon;
        }
        private void ParancsVegrehajtas(string parancs)
        {
            try
            {
                using (MySqlConnection con = new MySqlConnection(_connectionString))
                {
                    con.Open();
                    using (MySqlCommand command = new MySqlCommand(parancs, con))
                    {
                        command.ExecuteNonQuery();
                    }
                    con.Close();
                }
            }
            catch (Exception ex)
            {
                var message = ex.InnerException != null ? ex.InnerException.Message : ex.Message;
                MessageBox.Show(message, caption: "Hiba");
            }
        }
        private void TablaLekeres(string tabla)
        {          
            _aktualisTablaNeve = tabla;
            string query = "SELECT * FROM sport." + tabla;
            AdatokLekerese(query);
        }
        private void AdatokLekerese(string parancs)
        {
            try
            {
                using (MySqlConnection conn = new MySqlConnection(_connectionString))
                {
                    using (MySqlDataAdapter adapter = new MySqlDataAdapter(parancs, conn))
                    {
                        DataSet ds = new DataSet();
                        adapter.Fill(ds);
                        _aktualisTabla=ds.Tables[0];
                        AdatokMegjelenitese(ds.Tables[0]);
                    }
                }
            }
            catch (Exception ex)
            {
                var message = ex.InnerException != null ? ex.InnerException.Message : ex.Message;
                MessageBox.Show(message,caption: "Hiba");
            }
        }
        private void AdatokMegjelenitese(DataTable table)
        {
            dataGridView1.DataSource = table;
            label1.Text = "Találatok száma: " + table.Rows.Count;
        }
        private void Esemenyek(object sender, EventArgs e)
        {
            TablaLekeres("esemenyek");
           
        }

        private void Felhasznalok(object sender, EventArgs e)
        {
            TablaLekeres("felhasznalok");
        }

        private void Sportok(object sender, EventArgs e)
        {
            TablaLekeres("sportok");
        }

        private void Telepulesek(object sender, EventArgs e)
        {
            TablaLekeres("telepulesek");
        }

        private void Kereses(object sender, EventArgs e)
        {
            if (_aktualisTabla == null)
            {
                MessageBox.Show("Nem történt lekérdezés!","Hiba") ;
            }
            else
            {
                var tabla = _aktualisTabla.Copy();
                for (int i = tabla.Rows.Count - 1; i >= 0 ; i--)
                {
                    bool vanTalalat = false;                          
                    for (int j = tabla.Columns.Count - 1; j >= 0 ; j--)
                    {
                        var cellaErtek = tabla.Rows[i][j];
                        if (cellaErtek.ToString().ToLowerInvariant().StartsWith(textBox1.Text.ToLowerInvariant()))
                        {
                           vanTalalat = true;
                        }
                    }

                    if (!vanTalalat)
                    {
                        tabla.Rows.RemoveAt(i);
                    }
                }
                if (tabla.Rows.Count == 0)
                {
                    MessageBox.Show("Nincs találat", "Keresés");
                }
                else
                {
                    AdatokMegjelenitese(tabla);
                }
            }     
        }

        private void KeresesEnterre(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                Kereses(null,null);
                e.SuppressKeyPress = true;
            }
        }

        private void AblakMeretModosul(object sender, EventArgs e)
        {
            dataGridView1.Invalidate();
        }
        private void Bezaras(object sender, FormClosingEventArgs e)
        {
            Application.Exit();
        }

        private void button6_Click(object sender, EventArgs e)
        {
            if (_aktualisTabla == null) 
            {
                MessageBox.Show("Nem történt lekérdezés", "Hiba");
            }
            else if (dataGridView1.Rows.Count == 0)
            {
                MessageBox.Show("Nincs törölhető adat", "Hiba");
            }
            else
            {
                var kijeloltSorId = _aktualisTabla.Rows[dataGridView1.CurrentCell.RowIndex][0];
                SorTorlese(kijeloltSorId.ToString());
            }
        }
        private void SorTorlese(string Id)
        {
            string parancs = "DELETE FROM SPORT." + _aktualisTablaNeve + " WHERE " + _aktualisTabla.Columns[0].ColumnName + " = " + Id;
            ParancsVegrehajtas(parancs);
            TablaLekeres(_aktualisTablaNeve);
        }

        private void button7_Click(object sender, EventArgs e)
        {
            if (_aktualisTabla == null)
            {
                MessageBox.Show("Nem történt lekérdezés!", "Hiba");
            }
            else
            {
                var hozzaadas = new Hozzaadas(_aktualisTablaNeve, _aktualisTabla.Columns);

                var hozzaadasEredmeny = hozzaadas.ShowDialog();

                if (hozzaadasEredmeny == DialogResult.OK)
                {
                    TablaLekeres(_aktualisTablaNeve);
                }
            }
           
        }
    }
}

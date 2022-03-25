using MySql.Data.MySqlClient;
using System;
using System.Data;
using System.Windows.Forms;

namespace s_port
{
    public partial class Form1 : Form
    {
        private readonly string _connectionString = "datasource=localhost;port=3306;username=root;password=";
        private string _aktualisTabla = "";
       
        public Form1()
        {
            InitializeComponent();
        }
        private void TablaLekeres(string tabla)
        {
            _aktualisTabla = tabla;           
            string query = "SELECT * FROM sport." + tabla;
            AdatokLekerese(query);
        }
        private void AdatokLekerese(string parancs)
        {
            using (MySqlConnection conn = new MySqlConnection(_connectionString))
            {
                using (MySqlDataAdapter adapter = new MySqlDataAdapter(parancs, conn))
                {
                    DataSet ds = new DataSet();
                    adapter.Fill(ds);
                    AdatokMegjelenitese(ds.Tables[0]);
                }
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
            if (string.IsNullOrEmpty(_aktualisTabla))
            {
                MessageBox.Show("Nem történt lekérdezés!","Hiba") ;
            }
            else
            {
                string command = "SELECT * FROM sport." + _aktualisTabla;
                using (MySqlConnection conn = new MySqlConnection(_connectionString))
                {
                    using (MySqlDataAdapter adapter = new MySqlDataAdapter(command, conn))
                    {
                        DataSet ds = new DataSet();
                        adapter.Fill(ds);

                        for (int i = ds.Tables[0].Rows.Count - 1; i >= 0 ; i--)
                        {
                            bool vanTalalat = false;                          
                            for (int j = ds.Tables[0].Columns.Count - 1; j >= 0 ; j--)
                            {
                                var cellaErtek = ds.Tables[0].Rows[i][j];
                                if (string.Equals(cellaErtek.ToString(), textBox1.Text, StringComparison.OrdinalIgnoreCase))
                                {
                                    vanTalalat = true;
                                }
                            }

                            if (!vanTalalat)
                            {
                                ds.Tables[0].Rows.RemoveAt(i);
                            }
                        }
                        if (ds.Tables[0].Rows.Count == 0)
                        {
                            MessageBox.Show("Nincs találat", "Keresés");
                        }
                        else
                        {
                            AdatokMegjelenitese(ds.Tables[0]);
                        }
                    }
                }
            }
        }

        private void KeresesEnterre(object sender, KeyEventArgs e)
        {
            if (e.KeyCode == Keys.Enter)
            {
                Kereses(null,null);
            }
        }
    }
}

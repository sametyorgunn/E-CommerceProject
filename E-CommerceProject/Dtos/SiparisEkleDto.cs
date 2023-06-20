namespace E_CommerceProject.Dtos
{
    public class SiparisEkleDto
    {
        public string isim { get; set; }
        public string soyisim { get; set; }
        public string Ulke { get; set; }
        public string Sehir { get; set; }
        public string Adres { get; set; }
        public string Telefon { get; set; }
        public string odeme_turu { get; set; }
        public string? Mail { get; set; }
        public string? siparis_notu { get; set; }
        public string? SiparisKodu { get; set; }
        public decimal SepetToplam { get; set; }
    }
}

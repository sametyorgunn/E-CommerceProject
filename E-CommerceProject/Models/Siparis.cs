﻿using NuGet.Protocol.Core.Types;

namespace E_CommerceProject.Models
{
    public class Siparis
    {
        public int Id { get; set; }
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
        public decimal Siparis_toplam { get; set; }

    }
}

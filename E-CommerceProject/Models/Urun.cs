using System.ComponentModel.DataAnnotations.Schema;

namespace E_CommerceProject.Models
{
    public class Urun
    {
        public int Id { get; set; }
        public string Adi { get; set; }
        public string? Aciklama { get; set; }
        public decimal? Fiyat { get; set; }
        public decimal? indirimliFiyat { get; set; }
        public int Durum { get; set; }
        public string? ResimUrl { get; set; }
        [NotMapped]
        public IFormFile Resim { get; set; }

        public int KategoriId { get; set; }
        public Kategori Kategori { get; set; }
    }
}

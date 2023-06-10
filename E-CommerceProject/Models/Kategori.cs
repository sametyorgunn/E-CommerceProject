using System.ComponentModel.DataAnnotations.Schema;

namespace E_CommerceProject.Models
{
    public class Kategori
    {
        public int Id { get; set; }
        public string Adi { get; set; }
        public string? Sira { get; set; }
        public int? Durum { get; set; }
        public string? Slug { get; set; }
        public string? ResimUrl { get; set; }
        [NotMapped]
        public IFormFile Resim { get; set; }

        public List<Urun> Uruns { get; set; }
    }
}

using System.ComponentModel.DataAnnotations.Schema;

namespace E_CommerceProject.Models
{
    public class CokluResim
    {
        public int Id { get; set; }
        public string ResimYol { get; set; }
        [NotMapped]
        public IFormFile? Resim { get; set; }

        public int? UrunId { get; set; }
        public Urun Urun { get; set; }
    }
}

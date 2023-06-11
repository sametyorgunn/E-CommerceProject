using System.ComponentModel.DataAnnotations.Schema;

namespace E_CommerceProject.Models
{
    public class Referans
    {
        public int Id { get; set; }
        public string? Adi { get; set; }
        public string? ResimYol { get; set; }
        [NotMapped]
        public IFormFile Resim { get; set; }
    }
}

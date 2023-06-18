using E_CommerceProject.Models;

namespace E_CommerceProject.Dtos
{
    public class SepetDto
    {
        public Urun Urun { get; set; }
        public int? Adet { get; set; }
        public int UrunId { get; set; }
    }
}

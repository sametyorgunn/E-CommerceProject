namespace E_CommerceProject.Models
{
    public class Sepet
    {
        public int Id { get; set; }
        public int UrunId { get; set; }
        public Urun Urun { get; set; }  
        public int? Adet { get; set; }
        public int? UserId { get; set; }
    }
}

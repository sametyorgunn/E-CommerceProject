using E_CommerceProject.Dtos;
using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Identity;
using Microsoft.AspNetCore.Mvc;
using Microsoft.EntityFrameworkCore;
using System.Diagnostics;

namespace E_CommerceProject.Controllers
{
    public class SepetController : Controller
    {
        private readonly UserManager<Kullanici> _usermanager;

        public SepetController(UserManager<Kullanici> usermanager)
        {
            _usermanager = usermanager;
        }

        public IActionResult Index()
        {

            Context c = new Context();
            var user = User.Identity.Name;
            var userId = c.Users.Where(x=>x.UserName==user).Select(y=>y.Id).FirstOrDefault();
            var sepets = c.Sepets.Include(x=>x.Urun).Where(x=>x.UserId==userId).ToList();
            return View(sepets);

        }
        [HttpPost]
        public IActionResult SepeteEkle(int id,int adet,string fiyat,string indirimlifiyat,string urunadi)
        {
            
            Context c = new Context();
            var username = User.Identity.Name;
            var userId = c.Users.Where(x=>x.UserName==username).Select(y=>y.Id).FirstOrDefault();

            Sepet sepet = new Sepet
            {
                UrunId= id,
                UrunAdi =urunadi,
                Urun_fiyat = Convert.ToDecimal(fiyat),
                Urun_indirimli_fiyati = Convert.ToDecimal(indirimlifiyat),
                Adet = adet,
                UserId = userId
            };
            c.Sepets.Add(sepet);
            c.SaveChanges();

            return RedirectToAction("Index", "Sepet");
        }

        public IActionResult SepetAdetGuncelleArti(int adet,int sepetid,int urunid,decimal sepettoplam)
        {
            Context c = new Context();
            var username = User.Identity.Name;
            var userId = c.Users.Where(x => x.UserName == username).Select(y => y.Id).FirstOrDefault();
            Sepet sepet = new Sepet
            {
                Id = sepetid,
                Adet = adet+1,
                UserId = userId,
                UrunId = urunid
            };
            c.Sepets.Update(sepet);
            c.SaveChanges();
            return RedirectToAction("Index", "Sepet");
        }
        public IActionResult SepetAdetGuncelleEksi(int adet, int sepetid, int urunid,decimal sepettoplam)
        {
            Context c = new Context();
            var username = User.Identity.Name;
            var userId = c.Users.Where(x => x.UserName == username).Select(y => y.Id).FirstOrDefault();
            
            Sepet sepet = new Sepet
            {
                Id = sepetid,
                Adet = adet - 1,
                UserId = userId,
                UrunId = urunid
            };
            c.Sepets.Update(sepet);
            c.SaveChanges();
            return RedirectToAction("Index", "Sepet");

            //c.Sepets.Attach(sepet);
            //c.Entry(sepet).Property(x => x.Toplam).IsModified = true;
            //c.SaveChanges();
        }

        public IActionResult UrunSil(int id)
        {
            Context c = new Context();
            var urun = c.Sepets.Where(x => x.UrunId == id).FirstOrDefault();
            c.Sepets.Remove(urun);
            c.SaveChanges();
            return RedirectToAction("Index","Sepet");
        }


    }
}

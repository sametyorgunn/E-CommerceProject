using E_CommerceProject.Models;
using E_CommerceProject.Models.ContextDosya;
using Microsoft.AspNetCore.Mvc;
using NuGet.Packaging;

namespace E_CommerceProject.Areas.Admin.Controllers
{
    [Area("Admin")]

    public class UrunController : Controller
    {
        private readonly IWebHostEnvironment _environment;

        public UrunController(IWebHostEnvironment environment)
        {
            _environment = environment;
        }

        public IActionResult Index()
        {
            return View();
        }


        public IActionResult UrunEkle()
        {
            return View();
        }
        [HttpPost]
        public async Task<IActionResult> UrunEkle(Urun urun, List<IFormFile>ResimCoklu)
        {
            using(var c = new Context())
            {

                if (ResimCoklu != null && ResimCoklu.Count>0)
                {

                    //Bir ana resmi yükleme
                    string uploadsFolder = Path.Combine(_environment.WebRootPath, "resimler");
                    string uniqueFileName = Guid.NewGuid().ToString() + "_" + urun.Resim.FileName;
                    string filePath = Path.Combine(uploadsFolder, uniqueFileName);

                    using (var fileStream = new FileStream(filePath, FileMode.Create))
                    {
                        await urun.Resim.CopyToAsync(fileStream);
                    }
                    urun.ResimUrl = uniqueFileName;
                    c.Uruns.Add(urun);
                    c.SaveChanges();


                    //coklu birden fazla resimleri ekleme
                    foreach (var i in ResimCoklu)
                    {
                        string uploadsFolder1 = Path.Combine(_environment.WebRootPath, "resimler");
                        string uniqueFileName1 = Guid.NewGuid().ToString() + "_" + ResimCoklu;
                        string filePath1 = Path.Combine(uploadsFolder, uniqueFileName);

                        using (var fileStream = new FileStream(filePath, FileMode.Create))
                        {
                            await urun.Resim.CopyToAsync(fileStream);
                        }
                        CokluResim rsm = new CokluResim
                        {
                            ResimYol = uniqueFileName1,
                            UrunId = urun.Id
                        };
                        c.CokluResims.Add(rsm);
                        c.SaveChanges();

                    }
                    return Redirect("/Admin/Urun/UrunEkle");
                }
                else
                {
                    string uploadsFolder = Path.Combine(_environment.WebRootPath, "resimler");
                    string uniqueFileName = Guid.NewGuid().ToString() + "_" + urun.Resim.FileName;
                    string filePath = Path.Combine(uploadsFolder, uniqueFileName);

                    using (var fileStream = new FileStream(filePath, FileMode.Create))
                    {
                        await urun.Resim.CopyToAsync(fileStream);
                    }
                    urun.ResimUrl = uniqueFileName;
                    c.Uruns.Add(urun);
                    c.SaveChanges();
                    return Redirect("/Admin/Urun/UrunEkle");
                }
              


              


               
            }
        }
    }
}

using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class siparis : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.CreateTable(
                name: "siparis",
                columns: table => new
                {
                    Id = table.Column<int>(type: "int", nullable: false)
                        .Annotation("SqlServer:Identity", "1, 1"),
                    isim = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    soyisim = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Ulke = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Sehir = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Adres = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Telefon = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    odeme_turu = table.Column<string>(type: "nvarchar(max)", nullable: false),
                    Mail = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    siparis_notu = table.Column<string>(type: "nvarchar(max)", nullable: true),
                    SiparisKodu = table.Column<string>(type: "nvarchar(max)", nullable: true)
                },
                constraints: table =>
                {
                    table.PrimaryKey("PK_siparis", x => x.Id);
                });
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropTable(
                name: "siparis");
        }
    }
}

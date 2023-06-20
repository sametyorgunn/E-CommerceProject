using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class sepet_urundetaylar : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets");

            migrationBuilder.AlterColumn<int>(
                name: "UrunId",
                table: "Sepets",
                type: "int",
                nullable: true,
                oldClrType: typeof(int),
                oldType: "int");

            migrationBuilder.AddColumn<string>(
                name: "UrunAdi",
                table: "Sepets",
                type: "nvarchar(max)",
                nullable: true);

            migrationBuilder.AddColumn<decimal>(
                name: "Urun_fiyat",
                table: "Sepets",
                type: "decimal(18,2)",
                nullable: true);

            migrationBuilder.AddColumn<decimal>(
                name: "Urun_indirimli_fiyati",
                table: "Sepets",
                type: "decimal(18,2)",
                nullable: true);

            migrationBuilder.AddForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets",
                column: "UrunId",
                principalTable: "Uruns",
                principalColumn: "Id");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets");

            migrationBuilder.DropColumn(
                name: "UrunAdi",
                table: "Sepets");

            migrationBuilder.DropColumn(
                name: "Urun_fiyat",
                table: "Sepets");

            migrationBuilder.DropColumn(
                name: "Urun_indirimli_fiyati",
                table: "Sepets");

            migrationBuilder.AlterColumn<int>(
                name: "UrunId",
                table: "Sepets",
                type: "int",
                nullable: false,
                defaultValue: 0,
                oldClrType: typeof(int),
                oldType: "int",
                oldNullable: true);

            migrationBuilder.AddForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets",
                column: "UrunId",
                principalTable: "Uruns",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }
    }
}

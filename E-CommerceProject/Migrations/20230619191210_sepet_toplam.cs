using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class sepet_toplam : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<decimal>(
                name: "Toplam",
                table: "Sepets",
                type: "decimal(18,2)",
                nullable: true);

            migrationBuilder.CreateIndex(
                name: "IX_Sepets_UrunId",
                table: "Sepets",
                column: "UrunId");

            migrationBuilder.AddForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets",
                column: "UrunId",
                principalTable: "Uruns",
                principalColumn: "Id",
                onDelete: ReferentialAction.Cascade);
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_Sepets_Uruns_UrunId",
                table: "Sepets");

            migrationBuilder.DropIndex(
                name: "IX_Sepets_UrunId",
                table: "Sepets");

            migrationBuilder.DropColumn(
                name: "Toplam",
                table: "Sepets");
        }
    }
}

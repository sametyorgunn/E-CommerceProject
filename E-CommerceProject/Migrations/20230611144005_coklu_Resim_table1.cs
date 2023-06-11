using Microsoft.EntityFrameworkCore.Migrations;

#nullable disable

namespace E_CommerceProject.Migrations
{
    public partial class coklu_Resim_table1 : Migration
    {
        protected override void Up(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.AddColumn<int>(
                name: "UrunId",
                table: "CokluResims",
                type: "int",
                nullable: true);

            migrationBuilder.CreateIndex(
                name: "IX_CokluResims_UrunId",
                table: "CokluResims",
                column: "UrunId");

            migrationBuilder.AddForeignKey(
                name: "FK_CokluResims_Uruns_UrunId",
                table: "CokluResims",
                column: "UrunId",
                principalTable: "Uruns",
                principalColumn: "Id");
        }

        protected override void Down(MigrationBuilder migrationBuilder)
        {
            migrationBuilder.DropForeignKey(
                name: "FK_CokluResims_Uruns_UrunId",
                table: "CokluResims");

            migrationBuilder.DropIndex(
                name: "IX_CokluResims_UrunId",
                table: "CokluResims");

            migrationBuilder.DropColumn(
                name: "UrunId",
                table: "CokluResims");
        }
    }
}

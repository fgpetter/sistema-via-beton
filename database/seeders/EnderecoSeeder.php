<?php

namespace Database\Seeders;

use App\Enums\TipoEndereco;
use App\Models\Endereco;
use Illuminate\Database\Seeder;

class EnderecoSeeder extends Seeder
{
    public function run(): void
    {
        $enderecos = [
            ['nome' => 'AG ACEGUA', 'numero' => '1', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Barão do Rio Branco, 200', 'cidade_estado' => 'Aceguá/RS', 'fone' => '(53) 3245-1100'],
            ['nome' => 'AG AGENCIA DIGITAL', 'numero' => '2', 'horario' => '08:00 às 20:00', 'endereco' => 'Atendimento Digital', 'cidade_estado' => 'Porto Alegre/RS', 'fone' => '0800 729 0001'],
            ['nome' => 'AG AGUA SANTA', 'numero' => '3', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Coronel Fagundes, 50', 'cidade_estado' => 'Água Santa/RS', 'fone' => '(54) 3375-1200'],
            ['nome' => 'AG AGUAS CLARAS VIAMAO', 'numero' => '4', 'horario' => '10:00 às 15:00', 'endereco' => 'Av. Senador Salgado Filho, 3000', 'cidade_estado' => 'Viamão/RS', 'fone' => '(51) 3485-2300'],
            ['nome' => 'AG AGUDO', 'numero' => '5', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Adolfo Heck, 115', 'cidade_estado' => 'Agudo/RS', 'fone' => '(55) 3265-1400'],
            ['nome' => 'AG AJURICABA', 'numero' => '6', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Tiradentes, 890', 'cidade_estado' => 'Ajuricaba/RS', 'fone' => '(55) 3387-1500'],
            ['nome' => 'AG ALECRIM', 'numero' => '7', 'horario' => '10:00 às 16:00', 'endereco' => 'Rua Benjamin Constant, 710', 'cidade_estado' => 'Santa Maria/RS', 'fone' => '(55) 3222-1600'],
            ['nome' => 'AG ALEGRETE', 'numero' => '8', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Gaspar Martins, 325', 'cidade_estado' => 'Alegrete/RS', 'fone' => '(55) 3421-1700'],
            ['nome' => 'AG ALEGRIA', 'numero' => '9', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Marechal Floriano, 170', 'cidade_estado' => 'Alegria/RS', 'fone' => '(55) 3517-1800'],
            ['nome' => 'AG ALFREDO CHAVES', 'numero' => '10', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Flores da Cunha, 250', 'cidade_estado' => 'Veranópolis/RS', 'fone' => '(54) 3441-1900'],
            ['nome' => 'AG ALPESTRE', 'numero' => '11', 'horario' => '10:00 às 15:00', 'endereco' => 'Av. Porto Alegre, 400', 'cidade_estado' => 'Alpestre/RS', 'fone' => '(55) 3541-2000'],
            ['nome' => 'AG ALTO PETROPOLIS', 'numero' => '12', 'horario' => '10:00 às 16:00', 'endereco' => 'Av. Protásio Alves, 7400', 'cidade_estado' => 'Porto Alegre/RS', 'fone' => '(51) 3334-2100'],
            ['nome' => 'AG ALVORADA', 'numero' => '13', 'horario' => '10:00 às 15:00', 'endereco' => 'Av. Getúlio Vargas, 1500', 'cidade_estado' => 'Alvorada/RS', 'fone' => '(51) 3483-2200'],
            ['nome' => 'AG AMARAL FERRADOR', 'numero' => '14', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua General Osório, 180', 'cidade_estado' => 'Amaral Ferrador/RS', 'fone' => '(53) 3270-2300'],
            ['nome' => 'AG AMERICA JOINVILLE', 'numero' => '15', 'horario' => '10:00 às 16:00', 'endereco' => 'Rua América, 600', 'cidade_estado' => 'Joinville/SC', 'fone' => '(47) 3433-2400'],
            ['nome' => 'AG FORMIGUEIRO', 'numero' => '16', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua João Pessoa, 120', 'cidade_estado' => 'Formigueiro/RS', 'fone' => '(55) 3231-2500'],
            ['nome' => 'AG TANCREDO NEVES', 'numero' => '17', 'horario' => '10:00 às 16:00', 'endereco' => 'Av. Tancredo Neves, 1200', 'cidade_estado' => 'Porto Alegre/RS', 'fone' => '(51) 3341-2600'],
            ['nome' => 'AG MEDIANEIRA', 'numero' => '18', 'horario' => '10:00 às 15:00', 'endereco' => 'Av. Brasil, 550', 'cidade_estado' => 'Medianeira/PR', 'fone' => '(45) 3264-2700'],
            ['nome' => 'AG SAO BORJA', 'numero' => '19', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Aparício Mariense, 800', 'cidade_estado' => 'São Borja/RS', 'fone' => '(55) 3431-2800'],
            ['nome' => 'AG NOSSA SRA DAS DORES', 'numero' => '20', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Venâncio Aires, 350', 'cidade_estado' => 'Santa Maria/RS', 'fone' => '(55) 3222-2900'],
            ['nome' => 'AG QUARAI', 'numero' => '21', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Barão do Amazonas, 210', 'cidade_estado' => 'Quaraí/RS', 'fone' => '(55) 3423-3000'],
            ['nome' => 'AG ITAQUI', 'numero' => '22', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Bento Gonçalves, 670', 'cidade_estado' => 'Itaqui/RS', 'fone' => '(55) 3433-3100'],
            ['nome' => 'AG JARI', 'numero' => '23', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Principal, 100', 'cidade_estado' => 'Jari/RS', 'fone' => '(55) 3527-3200'],
            ['nome' => 'AG SAO GABRIEL', 'numero' => '24', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Marechal Deodoro, 450', 'cidade_estado' => 'São Gabriel/RS', 'fone' => '(55) 3232-3300'],
            ['nome' => 'AG FAXINAL DO SOTURNO', 'numero' => '25', 'horario' => '10:00 às 15:00', 'endereco' => 'Rua Julio de Castilhos, 300', 'cidade_estado' => 'Faxinal do Soturno/RS', 'fone' => '(55) 3263-3400'],
            ['nome' => 'PA CAPAO DO CIPO', 'numero' => '26', 'horario' => '10:00 às 14:00', 'endereco' => 'Av. Central, 50', 'cidade_estado' => 'Capão do Cipó/RS', 'fone' => '(55) 3611-3500'],
        ];

        foreach ($enderecos as $endereco) {
            Endereco::create(array_merge($endereco, [
                'tipo' => TipoEndereco::Agencia,
                'ativo' => true,
            ]));
        }
    }
}

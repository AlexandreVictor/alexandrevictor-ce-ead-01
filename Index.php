<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="pt-br">
    <head>
        <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
        
        <link rel='stylesheet'
          type='text/css'
          href='estilos.css'>

        <title>Trabalho EAD - 01</title>
    </head>
        <?php
            function f_Idade($AnoNascimento)
            {

               $DataAtual = Date('y-m-d');
               $DataAtual = date_create($DataAtual);
               $AnoNascimento = date_create($AnoNascimento);
               
               $Idade = date_diff($DataAtual, $AnoNascimento);
               return $Idade->format('%y');
            }
            function f_CalcIMC($Altura,$Peso)
            {
                $Altura = pow($Altura,2);
                return $Calc = number_format($Peso/$Altura,1);
            }
        ?>
    <body>
        <div>
            <p class="cabecalho">Promove Nutrição</p>
        </div>
        <div>
            <p class="meuspacientes"> Meus Pacientes</p>
        </div>
        <table  border = "1">
            <tr class="titulotabela">
                <th class="titulotabela">
                Nome
                </th>
                <th class="titulotabela">
                Peso(Kg)
                </th>
                <th class="titulotabela">
                Altura(M)
                </th>
                <th class="titulotabela">
                IMC
                </th>
                <th class="titulotabela">
                Data de Nascimento
                </th>
                <th class="titulotabela">
                Idade
                </th>
            </tr>
            <?php
                $delimitador = ";";
                $cadastro = fopen("cadastro.csv","r");
                if($cadastro)
                {
                    $cabecalho = fgetcsv($cadastro,0,$delimitador);
                    
                    while (!feof($cadastro)) 
                    {
                        $linha = fgetcsv($cadastro,0,$delimitador);
                        if(!$linha)
                        {
                                continue;
                        }
                        
                        $retorno = array_combine($cabecalho,$linha);
                        echo "<tr class='corpotabela'><td>".$retorno['NOME']."</td>";
                        echo "<td>".$retorno['PESO']."</td>";
                        echo "<td>".$retorno['ALTURA']."</td>";
                        $Alt =  ($retorno['ALTURA']);
                        $Peso = (float)($retorno['PESO']);
                        echo "<td>".f_CalcIMC($Alt,$Peso)."</td>";
                        echo "<td>".$retorno['DATA DE NASCIMENTO']."</td>";
                        $DataNasc = $retorno['DATA DE NASCIMENTO'];
                        $DtNsc=explode("/",$DataNasc);
                        $DataNasc=$DtNsc[2]."-".$DtNsc[1]."-".$DtNsc[0];
                        echo "<td>".f_Idade($DataNasc)."</td></tr>";

                    }

                    fclose($cadastro);
                }?>
        </table>
    </body>
</html>
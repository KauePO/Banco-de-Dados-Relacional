<?php
    //incluir arquivo de conexao
    require 'conexao.php';

    // verifica se os parametros foram enviados via POST
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        //recebe os parametros do formulario
        $param1 = isset($_POST['param1']) ? $_POST['param1'] : null;

        if($param1 !== null){
            try{
                $procedure = "sp_lista_clientes";
                //preparando a chamada da procedure
                $stmt = $pdo->prepare("CALL $procedure(:param1)");
                //Associar o parametro
                $stmt->bindParam(':param1', $param1, PDO::PARAM_INT);
                $stmt->execute();
                
                //Verifica se a procedure retornou algum registro
                if($stmt->rowCount()> 0){
                    echo "<h3>Resultados</h3>";
                    
                    echo "<table border='1' cellpadding='10'>";
                    echo "<tr>";

                    for($i = 0; $i <$stmt->columnCount(); $i++){
                        $meta = $stmt->getColumnMeta($i);
                        echo "<th>". htmlspecialchars($meta['name']). "</th>";
                    }

                    echo "</tr>";

                    //Obtendo as linhas
                    while($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                        echo "<tr>";
                        foreach($row as $col){
                            echo "<td>". htmlspecialchars($col). "</td>";
                        }
                        echo "</tr>";
                    }
                    echo "</table>";
                } else{
                    echo "A procedure não retornou nenhum dado!";
                }

            }catch(PDOException $e){
                echo "Erro ao chamar a procedure ". $e->getMessage();
            }
        }else{
            echo "Parametros inválidos.";
        }       
    }else {
        echo "Metodo Invalido. Use o formulario para enviar dados.";
    }
?>
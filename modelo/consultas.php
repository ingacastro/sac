<?php
function asignaCont($id_contingencia, $db, $id_funcionario, $vpn){
    if($id_funcionario!=0){
    $horaAsig=date("Y-m-d H:i:s");
    $sql="insert into asignacioncont (id_contingencia, id_funcionario, hora_asignacion, idvpn) "
    . "values ($id_contingencia, $id_funcionario, '$horaAsig', $vpn)";
    $db->query($sql);
    $cantidad="select * from contingente where id=$_POST[paises]";
    $res=$db->query($cantidad);
    $resultado=$res->fetch(PDO::FETCH_BOTH);
    $cont=$resultado['cantidad'];
    $cont++;
    $db->query("update contingente set cantidad=$cont where id=$_POST[paises]");
    }
}

function cantMetro($db){
    $qMetro="SELECT * FROM sac.contingencia A, sac.tabla_mesa B
    where A.codigo_centro=B.codigo 
    and (B.cod_estado=13 and (B.cod_municipio=9 or B.cod_municipio=16 or B.cod_municipio=18 or B.cod_municipio=19)
    or cod_estado=1)";
    $rsMetro=$db->query($qMetro);
    return $rsMetro;
}

function cantNac($db){
    $qNac="select * from sac.contingencia A where id_contingencia NOT IN
        (SELECT A.id_contingencia FROM sac.contingencia A, sac.tabla_mesa B
    where A.codigo_centro=B.codigo 
    and (B.cod_estado=13 and (B.cod_municipio=9 or B.cod_municipio=16 or B.cod_municipio=18 or B.cod_municipio=19)
    or cod_estado=1))";
    $rsNac=$db->query($qNac);
    return $rsNac;
}

function cantRDS($db){
    $qRDS="select * from contingencia where rds=1";
    $rsRDS=$db->query($qRDS);
    //return $rsRDS;
	return $qRDS;
}

function cantRIS($db){
    $qRDS="select * from contingencia where rds=2";
    $rsRDS=$db->query($qRDS);
    return $rsRDS;
}

function consAsig($db, $id){
    $qAsig="select * from asignacioncont where id_contingencia=$id";
    $rsAsig=$db->query($qAsig);
    return $rsAsig;
}

function consCatD($db, $c){
    $qCat="select * from categoria where idcategoria=$c";
    $rsCat=$db->query($qCat);
    $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
    $cat=new categoria ($rwCat['idcategoria'], $rwCat['descripcion_cat']);
    return $cat;
}

function consCat($db){
    $qCat="select * from categoria";
    $rsCat=$db->query($qCat);
    while($rwCat=$rsCat->fetch(PDO::FETCH_BOTH)){
        $cat[]= new categoria($rwCat['idcategoria'], $rwCat['descripcion_cat']);
    }
    return $cat;
}

function consCatg($db, $id){
    $qCat="select * from categoria where idcategoria=$id";
    $rsCat=$db->query($qCat);
    $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
    return $rwCat;
}

function consCen($db){
    $qCen="select codigo_centro, count(*) as 'cant' from contingencia 
    group by codigo_centro having cant>= 1 order by cant desc ";
    $rsCen=$db->query($qCen);
    $cen=array();
    while($rwCen=$rsCen->fetch(PDO::FETCH_BOTH)){
        $cen['codigo'][]=$rwCen['codigo_centro'];
        $cen['cantidad'][]=$rwCen['cant'];
    }
    return $cen;
}

function consCentro($db, $cod){
    $qCV="select * from tabla_mesa where codigo=$cod";
    $queryCV=$db->query($qCV);
    $rowCV=$queryCV->fetch(PDO::FETCH_BOTH);
    return $rowCV;
}

function consCnCt($db, $cod){
    $qCat="select D.cod_cat, count(*) as cant from cont_cat D,
        (select A.des_estado, id_contingencia from
        (select * from contingencia) B,
        (select * from tabla_mesa where cod_estado=$cod) A
        where A.codigo=B.codigo_centro
        ) C
        where D.id_contingencia=C.id_contingencia
        group by D.cod_cat
        order by C.des_estado
        ";
    $rsCat=$db->query($qCat);
    return $rsCat;
}

function consCnCtRDS($db, $tlf){
    $qCatRDS="select D.cod_cat, count(*) as cant from cont_cat D,
	(select A.telefono_contacto, A.id_contingencia from 
        (select * from contingencia) B,
        (select * from contingencia where telefono_contacto='$tlf') A
        where A.id_contingencia=B.id_contingencia
        )C
	where D.id_contingencia=C.id_contingencia
	group by D.cod_cat
        order by C.telefono_contacto
        ";
    $rsCatRDS=$db->query($qCatRDS);
    return $rsCatRDS;
}

function consCnCtRIS($db){
    $qCatRIS="select D.cod_cat, count(*) as cant from cont_cat D,
        (select * from contingencia where rds=2) B
        where D.id_contingencia=B.id_contingencia
        group by D.cod_cat
        ";
    $rsCatRIS=$db->query($qCatRIS);
    return $rsCatRIS;
}

function consCont($db, $cont){
    $qO="select * from contingente where id=$cont";
    $rsO=$db->query($qO);
    $rwO=$rsO->fetch(PDO::FETCH_BOTH);
    return $rwO;
}

function consContin($db){
    $qCont="select * from contingente";
    $cantidadA=$db->query($qCont);
    return $cantidadA;
}

function consCnEdo($db){
    $qCnCt="select B.cod_estado, B.des_estado, count(*) as cant from 
    (select codigo_centro, count(*) as cant from contingencia group by codigo_centro) A,
    sac.tabla_mesa B
    where A.codigo_centro=B.codigo
    group by B.cod_estado";
    $rsCnCt=$db->query($qCnCt);
    return $rsCnCt;
}

function consCnRDS($db){
    $qCnRDS="select B.telefono_contacto, count(*) as cant from
    (select codigo_centro, count(*) as cant from contingencia
    where rds=1
    group by codigo_centro) A,
    sac.contingencia B
    where A.codigo_centro=B.codigo_centro and B.rds=1
    group by B.telefono_contacto";
    $rsCnRDS=$db->query($qCnRDS);
    return $rsCnRDS;
}

function consCnRIS($db){
    $qCnRDS="select B.nombre_solicitante, count(*) as cant from 
    (select codigo_centro, count(*) as cant from contingencia where rds=2 group by codigo_centro) A,
    contingencia B
    where A.codigo_centro=B.codigo_centro and B.rds=2
    group by B.nombre_solicitante";
    $rsCnRDS=$db->query($qCnRDS);
    return $rsCnRDS;
}

function consCtg($db, $id){
    $qCont="select * from contingencia where id_contingencia=$id";
    $rsCont=$db->query($qCont);
    return $rsCont;
}

function consCtgAd($db){
    $q="select * from contingencia order by id_contingencia desc";
    $rsCtg=$db->query($q);
    return $rsCtg;
}

function consCtgR($db, $id){
    $qCont="select * from contingencia where id_contingencia=$id";
    $rsCont=$db->query($qCont);
    $rwCont=$rsCont->fetch(PDO::FETCH_BOTH);
    return $rwCont;
}

function consCtgUsu($id_usuario, $db, $tipo){
    if($id_usuario==0 && $tipo==6){
        $q="select * from contingencia where id_coordinador=0 and codigo_centro not in "
        . "(SELECT codigo FROM sac.tabla_mesa where cod_estado=1 or (cod_estado=13 and "
        . "(cod_municipio=18 or cod_municipio=19 or cod_municipio=16 or cod_municipio=9))) "
        . "order by id_contingencia desc";
    }else if($id_usuario==0 && $tipo!=6){
        $q="select * from contingencia where id_coordinador=0 and codigo_centro in "
        . "(SELECT codigo FROM sac.tabla_mesa where cod_estado=1 or (cod_estado=13 and "
        . "(cod_municipio=18 or cod_municipio=19 or cod_municipio=16 or cod_municipio=9))) "
        . "order by id_contingencia desc";
    }else{
        switch($tipo){
            case 1:
            case 6:
                $usu='id_usuario_registro';
            break;
            case 2:
                $usu='id_coordinador';
            break;
        }
        $q="select * from contingencia where $usu=$id_usuario order by id_contingencia desc";
    }
    $rsCtg=$db->query($q);
    return $rsCtg;
}

function consCtgNac($db){
    $q="select A.*
    from contingencia A, tabla_mesa B
    where A.codigo_centro=B.codigo and (B.cod_estado!=1 or
    (B.cod_estado=13 and (B.cod_municipio!=9 or B.cod_municipio!=18 or B.cod_municipio!=19 or B.cod_municipio!=16 )))
    and A.id_coordinador=0
    order by id_contingencia desc";
    $rsCtg=$db->query($q);
    return $rsCtg;
}

function conCtg($db, $v){
    if($v==1){
        $q="select A.*
        from contingencia A, tabla_mesa B
        where A.codigo_centro=B.codigo and (B.cod_estado=1 or
        (B.cod_estado=13 and (B.cod_municipio=9 or B.cod_municipio=18 or B.cod_municipio=19 or B.cod_municipio=16 )))
        order by id_contingencia desc";
    }
    if($v==4){
        $q="select A.*
        from contingencia A, tabla_mesa B
        where A.codigo_centro=B.codigo and (B.cod_estado!=1 or
        (B.cod_estado=13 and (B.cod_municipio!=9 or B.cod_municipio!=18 or B.cod_municipio!=19 or B.cod_municipio!=16 )))
        order by id_contingencia desc";
    }

    $rsCtg=$db->query($q);
    return $rsCtg;
}

function conDesRes($db, $id){
    $qDR="select des_res from resultadocont where id_contingencia=$id";
    $rsDR=$db->query($qDR);
    $rwDR=$rsDR->fetch(PDO::FETCH_BOTH);
    return utf8_encode($rwDR['des_res']);
}

function consDupCtg($db, $codigo){
    $qC="select * from contingencia where codigo_centro=$codigo";
    $rsC=$db->query($qC);
    return $rsC;
}

function consF($db, $func){
    $qFunc="select * from funcionario where ID=$func";
    $rsF=$db->query($qFunc);
    return $rsF;
}

function consFunc($db, $func){
    $qFunc="select * from funcionario where ID=$func";
    $rsF=$db->query($qFunc);
    $rwF=$rsF->fetch(PDO::FETCH_BOTH);
    return $rwF;
}

function consNacUsu($db, $idUsuario){
    $q="select * from contingencia where id_coordinador=$idUsuario and codigo_centro not in "
    . "(SELECT codigo FROM sac.tabla_mesa where cod_estado=13 and "
    . "(cod_municipio=18 or cod_municipio=19 or cod_municipio=16 or cod_municipio=9)) "
    . "order by id_contingencia desc";
    $rsCtg=$db->query($q);
    return $rsCtg;
}

function consR($db){
    $qRes="select * from resultadocont";
    $rsRes=$db->query($qRes);
    return $rsRes;
}

function consRes($db, $id){
    $qRes="select * from resultadocont where id_contingencia=$id";
    $rsRes=$db->query($qRes);
    $rwRes=$rsRes->fetch(PDO::FETCH_BOTH);
    return $rwRes;
}

function consSRes($db, $id){
    $qRes="select * from resultadocont where id_contingencia=$id";
    $rsRes=$db->query($qRes);
    return $rsRes;
}

function consultarRes($db, $id){
    $qRes="select * from resultadocont where id_contingencia=$id";
    $rsCat=$db->query($qRes);
    if($rsCat->rowCount()>=1){
        for($i=0; $i<$rsCat->rowCount(); $i++){
            $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
            $cat[$i]['cat']=$rwCat['id_res_cat'];
            $cat[$i]['sub']=$rwCat['id_res_sub'];
            $cat[$i]['hora']=$rwCat['hora_resultado'];
        }
        return $cat;
    }
}

function consSub($db, $c){
    $qSub="select * from subcategoria where cat=$c";
    $rsSub=$db->query($qSub);
    while($rwSub=$rsSub->fetch(PDO::FETCH_BOTH)){
        $sub[]=new subcategoria($rwSub['idsubcat'], $rwSub['cat'], $rwSub['sub'], $rwSub['desub']);
    }
    return $sub;
}

function consSubD($db, $s){
    $qSub="select * from subcategoria where idsubcat=$s";
    $rsSub=$db->query($qSub);
	$sub = "";
    while($rwSub=$rsSub->fetch(PDO::FETCH_BOTH)){
        $sub = new subcategoria($rwSub['idsubcat'], $rwSub['cat'], $rwSub['sub'], $rwSub['desub']);
		
    }
    return $sub;
}

function consSubCat($db, $sub){
    $qSub="select * from subcategoria where idsubcat=$sub";
    $rsSub=$db->query($qSub);
    $rwSub=$rsSub->fetch(PDO::FETCH_BOTH);
    return $rwSub;
}

function consVPN($db, $vpn){
    $qvpn="select * from vpn where idvpn=$vpn";
    $rsvpn=$db->query($qvpn);
    $rwvpn=$rsvpn->fetch(PDO::FETCH_BOTH);
    return $rwvpn;
}

function cont_cat($id_contingencia){
    $db=conectar();
    $qCat="select * from cont_cat where id_contingencia=$id_contingencia";
    $rsCat=$db->query($qCat);
    if($rsCat->rowCount()>=1){
        for($i=0; $i<$rsCat->rowCount(); $i++){
            $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
            $cat[$i]['cat']=$rwCat['cod_cat'];
            $cat[$i]['sub']=$rwCat['cod_sub'];
        }
        return $cat;
    }
}

function cont_catRes($db, $id_contingencia){
    $qCat="select * from resultadocont where id_contingencia=$id_contingencia";
    $rsCat=$db->query($qCat);
    if($rsCat->rowCount()>=1){
        for($i=0; $i<$rsCat->rowCount(); $i++){
            $rwCat=$rsCat->fetch(PDO::FETCH_BOTH);
            $cat[$i]['cat']=$rwCat['id_res_cat'];
            $cat[$i]['sub']=$rwCat['id_res_sub'];
        }
        return $cat;
    }
}

function consTM($db, $codigo){
    $qTM="select * from sac.tabla_mesa where codigo = $codigo";
    $query = $db->query($qTM);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function consTM2($db, $codigo){
    $qTM="select * from sac.tabla_mesa where codigo = $codigo";
    $query = $db->query($qTM);
    return $query;
}

function consTMNac($db, $codigo){
    $qTM="select * from sac.tabla_mesa where codigo = $codigo";
    $query = $db->query($qTM);
    $row = $query->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function consUsu($db, $idUsu){
    $qUR="select * from usuario where id_usuario=$idUsu";
    $qUsu=$db->query($qUR);
    $rwUsu=$qUsu->fetch(PDO::FETCH_BOTH);
    return $rwUsu;
}

function extraer($q, $db){
    if($_SESSION['cod_usuarioL']==6){
        $q="select distinct codigo, nombre, des_estado, des_municipio, des_parroquia from sac.tabla_mesa where nombre like '%$q%'";
    }else if($_SESSION['cod_usuarioL']!=6){
        $q="select distinct codigo, nombre, des_estado, des_municipio, des_parroquia from sac.tabla_mesa where nombre like '%$q%'";
        
    }
    
    $query = $db->query($q);
    
    if($query->rowCount()==0){
        echo 'No existe el centro de votación';	
    }else{
        while ($row = $query->fetch(PDO::FETCH_BOTH)){
            echo '<a href=buscar_por_centro.php?codigo='.$row['codigo'].'>'.utf8_encode($row['nombre']).'  '.utf8_encode($row['des_parroquia']).' '.utf8_encode($row['des_municipio']).' '.$row['des_estado'].'</a><br>';
        }
    }
}

function generaPaises(){
    $db=conectar();
    $consulta=$db->query("SELECT id, opcion FROM contingente");
    echo "<select class='form-control' name='paises' id='paises' onChange='cargaContenido(this.id)'>";
    echo "<option value='0'>Elige</option>";
    while($registro=$consulta->fetch(PDO::FETCH_BOTH)){
        echo "<option value='".$registro[0]."'>".utf8_encode($registro[1])."</option>";
    }
    echo "</select>";
}
function generaPaises2(){
    $db=conectar();
    $consulta=$db->query("SELECT id, opcion FROM contingente");
    echo "<tr><td><select class='form-control' name='paises2' id='paises2' onChange='cargaContenido2(this.id)'>";
    echo "<option value='0'>Elige</option>";
    while($registro=$consulta->fetch(PDO::FETCH_BOTH)){
        echo "<option value='".$registro[0]."'>".$registro[1]."</option>";
    }
    echo "</select></td></tr>";
}

function generaSelect($db){
    $q="SELECT distinct cod_estado, des_estado FROM select_1";
    $consulta=$db->query($q);
    echo "<select name='select1' id='select1' onChange='cargaContenido(this.id)' class=select3>";
    echo "<option value='0'>Elija Funcionario...</option>";
    while($registro=mysql_fetch_row($consulta)) {
            echo "<option value='".$registro[0]."'name='estado'>".$registro[1]."</option>";
    }
    echo "</select>";
}

function InsertarContingencia ($descCont, $horaLLa, $nomSol, $cedSol, $tlf, $ocup, $idUsuR, $codigo, $horaReg, $catg, $subCatg, $horaR, $rds){
    $db=conectar();
    $hora=date("H:i:s", strtotime($horaLLa));
    $dup=consDupCtg($db, $codigo);
    if($dup->rowCount()>=1){
?>
    <script type="text/javascript">
        r=confirm('¡Existe una llamada idéntica, por favor consulte sus registros!');
        if(r==true){
            var ok=1;
        }else{
            var ok=0;
        }
    </script>
<?php
    }

    $query = "insert into contingencia (descripcion_contingencia, hora_llamada, nombre_solicitante, cedula_solicitante, telefono_contacto, ocupacion_solicitante, id_usuario_registro, codigo_centro, hora_registro, hora, rds)"
    . " values ('$descCont', '$horaLLa', '$nomSol', '$cedSol', '$tlf', '$ocup', $idUsuR, $codigo, '$horaReg', '$horaR', $rds)";
    
    if($db->query($query)){
        $qId="select max(id_contingencia) from contingencia";
        $rsId=$db->query($qId);
        $rwId=$rsId->fetch(PDO::FETCH_BOTH);
        $id=$rwId[0];
        $cont=0;
        if(count($subCatg!=0) && $subCatg!=0){
			for($j=0; $j<count($subCatg); $j++){
				$qConCat="insert into cont_cat (id_contingencia, cod_cat, cod_sub, hora_reg)"
				. "values($id, ".$subCatg[$j]->cat.", ".$subCatg[$j]->idsubcat.", '$horaReg')";
				$cont=$cont+1;
				if($db->query($qConCat)){
				}else{
					"no registró contingencia";
				}
			}
		}else{
			$qConCat="insert into cont_cat (id_contingencia, cod_cat, cod_sub, hora_reg) "
			. "values($id, 0, 0, '$horaReg')";
			if($db->query($qConCat)){
			}else{
				"no registró contingencia";
			}
		}
        echo "<h1>Llamada Registrada con ".$cont." contingencia(s)</h1>";
    }else{
        echo "¡No se registró!"	;
    }

}

function insertResultC($db, $idContingencia, $idUsuRes, $desRes, $catRes, $subRes, $horaRes){
    $query="insert into resultadocont (id_contingencia, id_usuario_resultado, des_res, id_res_cat, id_res_sub, hora_resultado) "
        . "values($_GET[id_contingencia], $_SESSION[idUsuarioL], '$desRes', 0, 0, '$horaRes')";

    if($qIRC=$db->query($query)){
        return 1;
    }else{
        return 0;
    }
}

function InsertarResultado($db, $id, $idUsu, $desRes, $horaRes, $subCatg){

    if(count($subCatg!=0) && $subCatg!=0){
        for($j=0; $j<count($subCatg); $j++){
            $qResCat="insert into resultadocont(id_contingencia, id_usuario_resultado, des_res, id_res_cat, id_res_sub, hora_resultado)"
            . "values($id, $idUsu, '$desRes', ".$subCatg[$j]->cat.", ".$subCatg[$j]->idsubcat.", '$horaRes')";
        }
    }else{
        $qResCat="insert into resultadocont(id_contingencia, id_usuario_resultado, des_res, id_res_cat, id_res_sub, hora_resultado) "
        . "values($id, $idUsu, '$desRes', 0, 0, '$horaRes')";
    }
    
    if($db->query($qResCat)){

    }else{
        echo "no resultado";
        echo "<br/>";
    }

}

function reporteH($db){
    $qH="select
        case
        when hora between '01:00:00' and '2:00:59' then '1:00am - 2:00am'
        when hora between '02:01:00' and '3:00:59' then '2:00am - 3:00am'
        when hora between '03:01:00' and '4:00:59' then '3:00am - 4:00am'
        when hora between '04:01:00' and '5:00:59' then '4:00am - 5:00am'
        when hora between '05:01:00' and '6:00:59' then '5:00am - 6:00am'
        when hora between '06:01:00' and '7:00:59' then '6:00am - 7:00am'
        when hora between '07:01:00' and '8:00:59' then '7:00am - 8:00am'
        when hora between '8:01:00' and '9:00:59' then '8:00am - 9:00am'
        when hora between '9:01:00' and '10:00:59' then '9:00am - 10:00am'
        when hora between '10:01:00' and '11:00:59' then '10:00am - 11:00am'
        when hora between '11:01:00' and '12:00:59' then '11:00am - 12:00am'
        when hora between '12:01:00' and '13:00:59' then '12:00m - 1:00pm'
        when hora between '13:01:00' and '14:00:59' then '1:00pm - 2:00pm'
        when hora between '14:01:00' and '15:00:59' then '2:00pm - 3:00pm'
        when hora between '15:01:00' and '16:00:59' then '3:00pm - 4:00pm'
        when hora between '16:01:00' and '17:00:59' then '4:00pm - 5:00pm'
        when hora between '17:01:00' and '18:00:59' then '5:00pm - 6:00pm'
        when hora between '18:01:00' and '19:00:59' then '6:00pm - 7:00pm'
        when hora between '19:01:00' and '20:00:59' then '7:00pm - 8:00pm'
        when hora between '20:01:00' and '21:00:59' then '8:00pm - 9:00pm'
        when hora between '21:01:00' and '22:00:59' then '9:00pm - 10:00pm'
        when hora between '22:01:00' and '23:00:59' then '10:00pm - 11:00pm'
        when hora between '23:01:00' and '24:00' then '11:00pm - 12:00pm'
        end as 'hora',
        count(*) as 'cant' from contingencia
        group by 
        case
        when hora between '01:00:00' and '2:00:59' then '1 - 2'
        when hora between '02:01:00' and '3:00:59' then '2 - 3'
        when hora between '03:01:00' and '4:00:59' then '3 - 4'
        when hora between '04:01:00' and '5:00:59' then '4 - 5'
        when hora between '05:01:00' and '6:00:59' then '5 - 6'
        when hora between '06:01:00' and '7:00:59' then '6 - 7'
        when hora between '07:01:00' and '8:00:59' then '7 - 8'
        when hora between '8:01:00' and '9:00:59' then '8 - 9'
        when hora between '9:01:00' and '10:00:59' then '9 - 10'
        when hora between '10:01:00' and '11:00:59' then '10 - 11'
        when hora between '11:01:00' and '12:00:59' then '11 - 12'
        when hora between '12:01:00' and '13:00:59' then '12 - 13'
        when hora between '13:01:00' and '14:00:59' then '13 - 14'
        when hora between '14:01:00' and '15:00:59' then '14 - 15'
        when hora between '15:01:00' and '16:00:59' then '15 - 16'
        when hora between '16:01:00' and '17:00:59' then '16 - 17'
        when hora between '17:01:00' and '18:00:59' then '17 - 18'
        when hora between '18:01:00' and '19:00:59' then '18 - 19'
        when hora between '19:01:00' and '20:00:59' then '19 - 20'
        when hora between '20:01:00' and '21:00:59' then '20 - 21'
        when hora between '21:01:00' and '22:00:59' then '21 - 22'
        when hora between '22:01:00' and '23:00:59' then '22 - 23'
        when hora between '23:01:00' and '24:00:59' then '23 - 24'
        end
        order by hora_registro";
    $rsH=$db->query($qH);
    return $rsH;
}

function resCont($db, $idContingencia){
    $qRsCn="select * from resultadocont where id_contingencia=$idContingencia";
    $rsRsCn=$db->query($qRsCn);
    return $rsRsCn;
}

?>
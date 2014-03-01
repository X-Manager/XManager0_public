<table width="95%" border="0">
      <tr>
        <th height="21" colspan="2">&nbsp;</th>
      </tr>
      <tr bgcolor="#000033">
        <th height="50" colspan="2" bgcolor="#000033" class="RelatorioTitle">Ativos</th>
      </tr>
      <tr>
        <th height="21" colspan="2" bgcolor="#CCCCCC">Ativos imobilizados</th>
      </tr>
      <tr>
        <th width="62%" class="RelatorioField">Máquinas</th>
        <th width="38%" bgcolor="#FFC" class="RelatorioValue"> 
        <?php printf("%s", $GLOBALS['Balanco']['Maquinas']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Construções    predias</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Construcoes predias']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Terreno</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Terreno']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th height="21" colspan="2" bgcolor="#CCCCCC">Ativos circulantes</th>
      </tr>
      <tr>
        <th class="RelatorioField">Caixa</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Caixa']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Aplicações    financeiras</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Aplicacoes financeiras']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Vendas a    prazo a receber</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Vendas a prazo a receber']); ?></th>
      </tr>

      <tr>
        <th class="RelatorioField">Estoque    matéria prima</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Estoque materia prima']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Estoque    produto acabado</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Estoque produto acabado']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th class="RelatorioField">Total de ativos</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['TOTAL DE ATIVOS']); ?></th>
      </tr>
      <tr>
        <th height="21" colspan="2">&nbsp;</th>
      </tr>
      <tr bgcolor="#000033">
        <th height="50" colspan="2" bgcolor="#000033" class="RelatorioTitle"><p>Passivos</p></th>
      </tr>
      <tr>
        <th height="21" colspan="2" bgcolor="#CCCCCC">Passivos longo prazo</th>
      </tr>
      <tr>
        <th class="RelatorioField">Emprestimos    de longo prazo a pagar</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Emprestimos de longo prazo a pagar']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Juros    de emprestimos de longo prazo a pagar</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Juros de emprestimos de longo prazo a pagar']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th height="21" colspan="2" bgcolor="#CCCCCC">Passivos circulantes</th>
      </tr>
      <tr>
        <th class="RelatorioField">Emprestimo    de curto prazo a pagar</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Balanco']['Emprestimo de curto prazo a pagar']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Juros de    emprestimos de curto prazo a pagar</th>
        <th bgcolor="#FFC" class="RelatorioValue">
<?php printf("%s", $GLOBALS['Balanco']['Juros de emprestimos de curto prazo a pagar']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th class="RelatorioField">Total de passivos</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['TOTAL DE PASSIVOS']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr bgcolor="#000033">
        <th colspan="2" bgcolor="#000033" class="RelatorioTitle"><p>Patrimônio liquido</p></th>
      </tr>
      <tr>
        <th class="RelatorioField">Capital    social</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Capital social']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Lucros acumulados</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Lucros acumulados']); ?></th>
      </tr>
      <tr>
        <th class="RelatorioField">Patrimônio    líquido</th>
        <th bgcolor="#FFC" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Patrimonio liquido']); ?></th>
      </tr>
      <tr>
        <th colspan="2">&nbsp;</th>
      </tr>
      <tr>
        <th class="RelatorioField">Valor de venda da empresa</th>
        <th bgcolor="#FF0000" class="RelatorioValue"><?php printf("%s", $GLOBALS['Balanco']['Valor de venda da empresa']); ?></th>
      </tr>
    </table>

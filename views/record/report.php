  <div class="container">
	
	<h1>Laporan Gardu <?=$data['id_gardu']?></h1>
	<p>Tanggal <?=$data['date_min']?> hingga <?=$data['date_max']?></p>
	<br/>

	<ul type="number">
		<li><p>Data Gardu</p>
			<table min-width="50%" max-width="100%">
				<tr>			
					<td>Total daya</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?=$data['gardu_p']?> W</td>
				</tr>
				<tr>			
					<td>Daya pada phasa R</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?=$data['phasa_r']['p']?> W</td>
				</tr>
				<tr>			
					<td>Daya pada phasa S</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?=$data['phasa_s']['p']?> W</td>
				</tr>
				<tr>			
					<td>Daya pada phasa T</td>
					<td>&nbsp;:&nbsp;</td>
					<td><?=$data['phasa_t']['p']?> W</td>
				</tr>
			</table>
			<hr>
		</li>
		<li> <p>Gangguan</p>
			<table>
				<tbody>
					<tr>
						<?php 
							$voltage_standart=220;
							$v_under=0;
							if($data['phasa_r']['v']<($voltage_standart-(0.1*$voltage_standart)) && $v_under<$data['phasa_r']['v']) 
								$v_under = $data['phasa_r']['v'];
							if($data['phasa_s']['v']<($voltage_standart-(0.1*$voltage_standart)) && $v_under<$data['phasa_s']['v']) 
								$v_under = $data['phasa_r']['v'];
							if($data['phasa_t']['v']<($voltage_standart-(0.1*$voltage_standart)) && $v_under<$data['phasa_t']['v']) 
								$v_under = $data['phasa_r']['v'];
						?>
						<td>Under Voltage</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=$v_under?> V</td>
					</tr>
					<tr>
						<?php 
							$voltage_standart = 220;
							$v_over = 0;
							if($data['phasa_r']['v']<($voltage_standart+(0.05*$voltage_standart)) && $v_under<$data['phasa_r']['v']) 
								$v_under = $data['phasa_r']['v'];
							if($data['phasa_s']['v']<($voltage_standart+(0.05*$voltage_standart)) && $v_under<$data['phasa_s']['v']) 
								$v_under = $data['phasa_r']['v'];
							if($data['phasa_t']['v']<($voltage_standart+(0.05*$voltage_standart)) && $v_under<$data['phasa_t']['v']) 
								$v_under = $data['phasa_r']['v'];
						?>
						<td>Over Voltage</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=$data['s_locking']?> V</td>
					</tr>
					<tr>
						<?php
							$v_average = ($data['phasa_r']['v'] + $data['phasa_s']['v'] + $data['phasa_t']['v']) / 3;
							$sv_r = $data['phasa_r']['v'] - $v_average;
							$sv_s = $data['phasa_s']['v'] - $v_average;
							$sv_t = $data['phasa_t']['v'] - $v_average;
							
							$unbalance = $sv_r;
							if($sv_s>$sv_r)
								$unbalance = $sv_s;
							if($sv_t>$sv_s)
								$unbalance = $sv_t;

							$unbalance = ($unbalance/$v_average)*100;
						?>
						<td>Unbalance</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=number_format($unbalance,2)?>%</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"></td>
					</tr>
				</tfoot>
			</table>
			<hr>
		</li>
		<li> <p>System locking</p>
			<table>
				<tbody>
					<tr>
						<td>Phasa R</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=$data['r_locking']?> pelanggan</td>
					</tr>
					<tr>
						<td>Phasa S</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=$data['s_locking']?> pelanggan</td>
					</tr>
					<tr>
						<td>Phasa T</td>
						<td>&nbsp;:&nbsp;</td>
						<td><?=$data['t_locking']?> pelanggan</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<td colspan="3"></td>
					</tr>
				</tfoot>
			</table>
			<hr>
		</li>
		<table style="width:100%; background-color: <?=($data['status_locking']==0?'#C8E6C9':($data['status_locking']==1?'#FFEE58':($data['status_locking']==2?'#FFA726':'#E57373')))?>">
			<tbody>
				<tr>
					<td style="vertical-align: top;">Kesimpulan</td>
					<td style="vertical-align: top;">&nbsp;:&nbsp;</td>
					<td>Ada <?=($data['r_locking'])?> system locking pada phasa R, <?=($data['s_locking'])?> system locking pada phasa S, dan <?=($data['t_locking'])?> system locking pada phasa T sehingga <?=$data['status_unbalance']==1?'tidak':''?> terjadi unbalance.</td>
				</tr>
			</tbody>
		</table>
	<?php 
	if($data['status_locking'] > 0) { ?>
	<p>Data locking</p>
	<table>
		<tbody>
			<tr>
				<td>data</td>
			</tr>
		</tbody>
	</table>
	<?php }
	?>
 </div>
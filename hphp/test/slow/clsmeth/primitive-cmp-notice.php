<?hh

class Info { static bool $SawError = false; }
function handle_error($_errno, $msg, ...) {
  if (Info::$SawError) return false;
  if (
    !preg_match('/Implicit clsmeth to [^ ]+ conversion/', $msg) &&
    strpos($msg, 'Comparing clsmeth with vec') === false &&
    strpos($msg, 'Comparing clsmeth with non-clsmeth') === false &&
    strpos($msg, 'Comparing clsmeth with clsmeth relationally') === false
  ) {
    return false;
  }
  Info::$SawError = true;
  return true;
}

class Foo { static function bar() {} static function baz() {} }
class StrObj {
  public function __construct(private string $s) {}
  public function __toString(): string { return $this->s; }
}
class Wrapper { public function __construct(private mixed $w) {} }

function bar() {}

function LV($x)  { return __hhvm_intrinsics\launder_value($x); }
function CLS($c) { return __hhvm_intrinsics\create_class_pointer($c); }

function WRAPA($x) { return LV(varray[$x]); }
function WRAPO($x) { return LV(new Wrapper($x)); }
function WRAPD($x) { $r = new stdclass; $r->x = $x; return LV($r); }

<<__NEVER_INLINE>> function print_header($title) {
  echo "$title\n";
  echo "+------------+------+------+------+------+------+------+------+\n";
  echo "| VAR        | <    | <=   | >    | >=   | ==   | ===  | <=>  |\n";
  echo "+============+======+======+======+======+======+======+======+";
}
<<__NEVER_INLINE>> function begin_row($var, $wrap = null) {
  printf("\n| %-10s |", $wrap !== null ? $wrap."(\$$var)" : "\$$var");
}
<<__NEVER_INLINE>> function C(bool $v) {
  printf(" %-4s |", ($v ? 'T' : 'F').(Info::$SawError ? '*' : ''));
  Info::$SawError = false;
}
<<__NEVER_INLINE>> function Cx($f) {
  try {
    C($f());
  } catch (InvalidOperationException $e) {
    print(" EXN  |");
    Info::$SawError = false;
  }
}
<<__NEVER_INLINE>> function I(int $v) {
  printf(" %-2d%s  |", $v, Info::$SawError ? '*' : ' ');
  Info::$SawError = false;
}
<<__NEVER_INLINE>> function Ix($f) {
  try {
    I($f());
  } catch (InvalidOperationException $e) {
    print(" EXN  |");
    Info::$SawError = false;
  }
}
<<__NEVER_INLINE>> function print_footer() {
  echo "\n+------------+------+------+------+------+------+------+------+\n\n";
}

<<__NEVER_INLINE>> function static_compare() {
  $cm = class_meth(Foo::class, 'bar');
  $nv = null;
  $tv = true;
  $bv = false;
  $iv = 42;
  $fv = 3.14159;
  $sv = 'Foo::bar';
  $rv = opendir(getcwd());
  $ov = new StrObj('Foo::bar');
  $va = varray[Foo::class, 'bar'];
  $da = darray[0 => Foo::class, 1 => 'bar'];
  $cp = class_meth(Foo::class, 'bar');
  $ep = bar<>;
  $lp = class_meth(Foo::class, 'baz');
  $qp = CLS('Foo');

  $xx = varray[$cm]; $nx = varray[$nv]; $tx = varray[$tv]; $bx = varray[$bv];
  $ix = varray[$iv]; $fx = varray[$fv]; $sx = varray[$sv]; $rx = varray[$rv];
  $ox = varray[$ov]; $vx = varray[$va]; $dx = varray[$da]; $cx = varray[$cp];
  $ex = varray[$ep]; $lx = varray[$lp]; $qx = varray[$qp];

  $xy = new Wrapper($cm); $ny = new Wrapper($nv); $ty = new Wrapper($tv);
  $by = new Wrapper($bv); $iy = new Wrapper($iv); $fy = new Wrapper($fv);
  $sy = new Wrapper($sv); $ry = new Wrapper($rv); $oy = new Wrapper($ov);
  $vy = new Wrapper($va); $dy = new Wrapper($da); $cy = new Wrapper($cp);
  $ey = new Wrapper($ep); $ly = new Wrapper($lp); $qy = new Wrapper($qp);

  $xz = new stdclass; $xz->v = $cm; $nz = new stdclass; $nz->v = $nv;
  $tz = new stdclass; $tz->v = $tv; $bz = new stdclass; $bz->v = $bv;
  $iz = new stdclass; $iz->v = $iv; $fz = new stdclass; $fz->v = $fv;
  $sz = new stdclass; $sz->v = $sv; $rz = new stdclass; $rz->v = $rv;
  $oz = new stdclass; $oz->v = $ov; $vz = new stdclass; $vz->v = $va;
  $dz = new stdclass; $dz->v = $da; $cz = new stdclass; $cz->v = $cp;
  $ez = new stdclass; $ez->v = $ep; $lz = new stdclass; $lz->v = $lp;
  $qz = new stdclass; $qz->v = $qp;

  print_header('[static] $cm ? VAR');
  begin_row('cm');
    C($cm<$cm);C($cm<=$cm);C($cm>$cm);C($cm>=$cm);C($cm==$cm);C($cm===$cm);
    I($cm<=>$cm);
  begin_row('nv');
    C($cm<$nv);C($cm<=$nv);C($cm>$nv);C($cm>=$nv);C($cm==$nv);C($cm===$nv);
    I($cm<=>$nv);
  begin_row('tv');
    C($cm<$tv);C($cm<=$tv);C($cm>$tv);C($cm>=$tv);C($cm==$tv);C($cm===$tv);
    I($cm<=>$tv);
  begin_row('bv');
    C($cm<$bv);C($cm<=$bv);C($cm>$bv);C($cm>=$bv);C($cm==$bv);C($cm===$bv);
    I($cm<=>$bv);
  begin_row('iv');
    C($cm<$iv);C($cm<=$iv);C($cm>$iv);C($cm>=$iv);C($cm==$iv);C($cm===$iv);
    I($cm<=>$iv);
  begin_row('fv');
    C($cm<$fv);C($cm<=$fv);C($cm>$fv);C($cm>=$fv);C($cm==$fv);C($cm===$fv);
    I($cm<=>$fv);
  begin_row('sv');
    C($cm<$sv);C($cm<=$sv);C($cm>$sv);C($cm>=$sv);C($cm==$sv);C($cm===$sv);
    I($cm<=>$sv);
  begin_row('rv');
    C($cm<$rv);C($cm<=$rv);C($cm>$rv);C($cm>=$rv);C($cm==$rv);C($cm===$rv);
    I($cm<=>$rv);
  begin_row('ov');
    C($cm<$ov);C($cm<=$ov);C($cm>$ov);C($cm>=$ov);C($cm==$ov);C($cm===$ov);
    I($cm<=>$ov);
  begin_row('va');
    C($cm<$va);C($cm<=$va);C($cm>$va);C($cm>=$va);C($cm==$va);C($cm===$va);
    I($cm<=>$va);
  begin_row('cp');
    C($cm<$cp);C($cm<=$cp);C($cm>$cp);C($cm>=$cp);C($cm==$cp);C($cm===$cp);
    I($cm<=>$cp);
  begin_row('ep');
    Cx(() ==> $cm<$ep);Cx(() ==> $cm<=$ep);Cx(() ==> $cm>$ep);Cx(() ==> $cm>=$ep);Cx(() ==> $cm==$ep);Cx(() ==> $cm===$ep);
    Ix(() ==> $cm<=>$ep);
  begin_row('lp');
    C($cm<$lp);C($cm<=$lp);C($cm>$lp);C($cm>=$lp);C($cm==$lp);C($cm===$lp);
    I($cm<=>$lp);
  begin_row('qp');
    C($cm<$qp);C($cm<=$qp);C($cm>$qp);C($cm>=$qp);C($cm==$qp);C($cm===$qp);
    I($cm<=>$qp);

  begin_row('nv', 'WRAPA');
    C($xx<$nx);C($xx<=$nx);C($xx>$nx);C($xx>=$nx);C($xx==$nx);C($xx===$nx);
    I($xx<=>$nx);
  begin_row('tv', 'WRAPA');
    C($xx<$tx);C($xx<=$tx);C($xx>$tx);C($xx>=$tx);C($xx==$tx);C($xx===$tx);
    I($xx<=>$tx);
  begin_row('bv', 'WRAPA');
    C($xx<$bx);C($xx<=$bx);C($xx>$bx);C($xx>=$bx);C($xx==$bx);C($xx===$bx);
    I($xx<=>$bx);
  begin_row('iv', 'WRAPA');
    C($xx<$ix);C($xx<=$ix);C($xx>$ix);C($xx>=$ix);C($xx==$ix);C($xx===$ix);
    I($xx<=>$ix);
  begin_row('fv', 'WRAPA');
    C($xx<$fx);C($xx<=$fx);C($xx>$fx);C($xx>=$fx);C($xx==$fx);C($xx===$fx);
    I($xx<=>$fx);
  begin_row('sv', 'WRAPA');
    C($xx<$sx);C($xx<=$sx);C($xx>$sx);C($xx>=$sx);C($xx==$sx);C($xx===$sx);
    I($xx<=>$sx);
  begin_row('rv', 'WRAPA');
    C($xx<$rx);C($xx<=$rx);C($xx>$rx);C($xx>=$rx);C($xx==$rx);C($xx===$rx);
    I($xx<=>$rx);
  begin_row('ov', 'WRAPA');
    C($xx<$ox);C($xx<=$ox);C($xx>$ox);C($xx>=$ox);C($xx==$ox);C($xx===$ox);
    I($xx<=>$ox);
  begin_row('va', 'WRAPA');
    C($xx<$vx);C($xx<=$vx);C($xx>$vx);C($xx>=$vx);C($xx==$vx);C($xx===$vx);
    I($xx<=>$vx);
  begin_row('cp', 'WRAPA');
    C($xx<$cx);C($xx<=$cx);C($xx>$cx);C($xx>=$cx);C($xx==$cx);C($xx===$cx);
    I($xx<=>$cx);
  begin_row('ep', 'WRAPA');
    Cx(() ==> $xx<$ex);Cx(() ==> $xx<=$ex);Cx(() ==> $xx>$ex);Cx(() ==> $xx>=$ex);Cx(() ==> $xx==$ex);Cx(() ==> $xx===$ex);
    Ix(() ==> $xx<=>$ex);
  begin_row('lp', 'WRAPA');
    C($xx<$lx);C($xx<=$lx);C($xx>$lx);C($xx>=$lx);C($xx==$lx);C($xx===$lx);
    I($xx<=>$lx);
  begin_row('qp', 'WRAPA');
    C($xx<$qx);C($xx<=$qx);C($xx>$qx);C($xx>=$qx);C($xx==$qx);C($xx===$qx);
    I($xx<=>$qx);

  begin_row('nv', 'WRAPO');
    C($xy<$ny);C($xy<=$ny);C($xy>$ny);C($xy>=$ny);C($xy==$ny);C($xy===$ny);
    I($xy<=>$ny);
  begin_row('tv', 'WRAPO');
    C($xy<$ty);C($xy<=$ty);C($xy>$ty);C($xy>=$ty);C($xy==$ty);C($xy===$ty);
    I($xy<=>$ty);
  begin_row('bv', 'WRAPO');
    C($xy<$by);C($xy<=$by);C($xy>$by);C($xy>=$by);C($xy==$by);C($xy===$by);
    I($xy<=>$by);
  begin_row('iv', 'WRAPO');
    C($xy<$iy);C($xy<=$iy);C($xy>$iy);C($xy>=$iy);C($xy==$iy);C($xy===$iy);
    I($xy<=>$iy);
  begin_row('fv', 'WRAPO');
    C($xy<$fy);C($xy<=$fy);C($xy>$fy);C($xy>=$fy);C($xy==$fy);C($xy===$fy);
    I($xy<=>$fy);
  begin_row('sv', 'WRAPO');
    C($xy<$sy);C($xy<=$sy);C($xy>$sy);C($xy>=$sy);C($xy==$sy);C($xy===$sy);
    I($xy<=>$sy);
  begin_row('rv', 'WRAPO');
    C($xy<$ry);C($xy<=$ry);C($xy>$ry);C($xy>=$ry);C($xy==$ry);C($xy===$ry);
    I($xy<=>$ry);
  begin_row('ov', 'WRAPO');
    C($xy<$oy);C($xy<=$oy);C($xy>$oy);C($xy>=$oy);C($xy==$oy);C($xy===$oy);
    I($xy<=>$oy);
  begin_row('va', 'WRAPO');
    C($xy<$vy);C($xy<=$vy);C($xy>$vy);C($xy>=$vy);C($xy==$vy);C($xy===$vy);
    I($xy<=>$vy);
  begin_row('cp', 'WRAPO');
    C($xy<$cy);C($xy<=$cy);C($xy>$cy);C($xy>=$cy);C($xy==$cy);C($xy===$cy);
    I($xy<=>$cy);
  begin_row('ep', 'WRAPO');
    Cx(() ==> $xy<$ey);Cx(() ==> $xy<=$ey);Cx(() ==> $xy>$ey);Cx(() ==> $xy>=$ey);Cx(() ==> $xy==$ey);Cx(() ==> $xy===$ey);
    Ix(() ==> $xy<=>$ey);
  begin_row('lp', 'WRAPO');
    C($xy<$ly);C($xy<=$ly);C($xy>$ly);C($xy>=$ly);C($xy==$ly);C($xy===$ly);
    I($xy<=>$ly);
  begin_row('qp', 'WRAPO');
    C($xy<$qy);C($xy<=$qy);C($xy>$qy);C($xy>=$qy);C($xy==$qy);C($xy===$qy);
    I($xy<=>$qy);

  begin_row('nv', 'WRAPD');
    C($xz<$nz);C($xz<=$nz);C($xz>$nz);C($xz>=$nz);C($xz==$nz);C($xz===$nz);
    I($xz<=>$nz);
  begin_row('tv', 'WRAPD');
    C($xz<$tz);C($xz<=$tz);C($xz>$tz);C($xz>=$tz);C($xz==$tz);C($xz===$tz);
    I($xz<=>$tz);
  begin_row('bv', 'WRAPD');
    C($xz<$bz);C($xz<=$bz);C($xz>$bz);C($xz>=$bz);C($xz==$bz);C($xz===$bz);
    I($xz<=>$bz);
  begin_row('iv', 'WRAPD');
    C($xz<$iz);C($xz<=$iz);C($xz>$iz);C($xz>=$iz);C($xz==$iz);C($xz===$iz);
    I($xz<=>$iz);
  begin_row('fv', 'WRAPD');
    C($xz<$fz);C($xz<=$fz);C($xz>$fz);C($xz>=$fz);C($xz==$fz);C($xz===$fz);
    I($xz<=>$fz);
  begin_row('sv', 'WRAPD');
    C($xz<$sz);C($xz<=$sz);C($xz>$sz);C($xz>=$sz);C($xz==$sz);C($xz===$sz);
    I($xz<=>$sz);
  begin_row('rv', 'WRAPD');
    C($xz<$rz);C($xz<=$rz);C($xz>$rz);C($xz>=$rz);C($xz==$rz);C($xz===$rz);
    I($xz<=>$rz);
  begin_row('ov', 'WRAPD');
    C($xz<$oz);C($xz<=$oz);C($xz>$oz);C($xz>=$oz);C($xz==$oz);C($xz===$oz);
    I($xz<=>$oz);
  begin_row('va', 'WRAPD');
    C($xz<$vz);C($xz<=$vz);C($xz>$vz);C($xz>=$vz);C($xz==$vz);C($xz===$vz);
    I($xz<=>$vz);
  begin_row('cp', 'WRAPD');
    C($xz<$cz);C($xz<=$cz);C($xz>$cz);C($xz>=$cz);C($xz==$cz);C($xz===$cz);
    I($xz<=>$cz);
  begin_row('ep', 'WRAPD');
    Cx(() ==> $xz<$ez);Cx(() ==> $xz<=$ez);Cx(() ==> $xz>$ez);Cx(() ==> $xz>=$ez);Cx(() ==> $xz==$ez);Cx(() ==> $xz===$ez);
    Ix(() ==> $xz<=>$ez);
  begin_row('lp', 'WRAPD');
    C($xz<$lz);C($xz<=$lz);C($xz>$lz);C($xz>=$lz);C($xz==$lz);C($xz===$lz);
    I($xz<=>$lz);
  begin_row('qp', 'WRAPD');
    C($xz<$qz);C($xz<=$qz);C($xz>$qz);C($xz>=$qz);C($xz==$qz);C($xz===$qz);
    I($xz<=>$qz);
  print_footer();

  print_header('[static] VAR ? $cm');
  begin_row('cm');
    C($cm<$cm);C($cm<=$cm);C($cm>$cm);C($cm>=$cm);C($cm==$cm);C($cm===$cm);
    I($cm<=>$cm);
  begin_row('nv');
    C($nv<$cm);C($nv<=$cm);C($nv>$cm);C($nv>=$cm);C($nv==$cm);C($nv===$cm);
    I($nv<=>$cm);
  begin_row('tv');
    C($tv<$cm);C($tv<=$cm);C($tv>$cm);C($tv>=$cm);C($tv==$cm);C($tv===$cm);
    I($tv<=>$cm);
  begin_row('bv');
    C($bv<$cm);C($bv<=$cm);C($bv>$cm);C($bv>=$cm);C($bv==$cm);C($bv===$cm);
    I($bv<=>$cm);
  begin_row('iv');
    C($iv<$cm);C($iv<=$cm);C($iv>$cm);C($iv>=$cm);C($iv==$cm);C($iv===$cm);
    I($iv<=>$cm);
  begin_row('fv');
    C($fv<$cm);C($fv<=$cm);C($fv>$cm);C($fv>=$cm);C($fv==$cm);C($fv===$cm);
    I($fv<=>$cm);
  begin_row('sv');
    C($sv<$cm);C($sv<=$cm);C($sv>$cm);C($sv>=$cm);C($sv==$cm);C($sv===$cm);
    I($sv<=>$cm);
  begin_row('rv');
    C($rv<$cm);C($rv<=$cm);C($rv>$cm);C($rv>=$cm);C($rv==$cm);C($rv===$cm);
    I($rv<=>$cm);
  begin_row('ov');
    C($ov<$cm);C($ov<=$cm);C($ov>$cm);C($ov>=$cm);C($ov==$cm);C($ov===$cm);
    I($ov<=>$cm);
  begin_row('va');
    C($va<$cm);C($va<=$cm);C($va>$cm);C($va>=$cm);C($va==$cm);C($va===$cm);
    I($va<=>$cm);
  begin_row('cp');
    C($cp<$cm);C($cp<=$cm);C($cp>$cm);C($cp>=$cm);C($cp==$cm);C($cp===$cm);
    I($cp<=>$cm);
  begin_row('ep');
    Cx(() ==> $ep<$cm);Cx(() ==> $ep<=$cm);Cx(() ==> $ep>$cm);Cx(() ==> $ep>=$cm);Cx(() ==> $ep==$cm);Cx(() ==> $ep===$cm);
    Ix(() ==> $ep<=>$cm);
  begin_row('lp');
    C($lp<$cm);C($lp<=$cm);C($lp>$cm);C($lp>=$cm);C($lp==$cm);C($lp===$cm);
    I($lp<=>$cm);
  begin_row('qp');
    C($qp<$cm);C($qp<=$cm);C($qp>$cm);C($qp>=$cm);C($qp==$cm);C($qp===$cm);
    I($qp<=>$cm);

  begin_row('nv', 'WRAPA');
    C($nx<$xx);C($nx<=$xx);C($nx>$xx);C($nx>=$xx);C($nx==$xx);C($nx===$xx);
    I($nx<=>$xx);
  begin_row('tv', 'WRAPA');
    C($tx<$xx);C($tx<=$xx);C($tx>$xx);C($tx>=$xx);C($tx==$xx);C($tx===$xx);
    I($tx<=>$xx);
  begin_row('bv', 'WRAPA');
    C($bx<$xx);C($bx<=$xx);C($bx>$xx);C($bx>=$xx);C($bx==$xx);C($bx===$xx);
    I($bx<=>$xx);
  begin_row('iv', 'WRAPA');
    C($ix<$xx);C($ix<=$xx);C($ix>$xx);C($ix>=$xx);C($ix==$xx);C($ix===$xx);
    I($ix<=>$xx);
  begin_row('fv', 'WRAPA');
    C($fx<$xx);C($fx<=$xx);C($fx>$xx);C($fx>=$xx);C($fx==$xx);C($fx===$xx);
    I($fx<=>$xx);
  begin_row('sv', 'WRAPA');
    C($sx<$xx);C($sx<=$xx);C($sx>$xx);C($sx>=$xx);C($sx==$xx);C($sx===$xx);
    I($sx<=>$xx);
  begin_row('rv', 'WRAPA');
    C($rx<$xx);C($rx<=$xx);C($rx>$xx);C($rx>=$xx);C($rx==$xx);C($rx===$xx);
    I($rx<=>$xx);
  begin_row('ov', 'WRAPA');
    C($ox<$xx);C($ox<=$xx);C($ox>$xx);C($ox>=$xx);C($ox==$xx);C($ox===$xx);
    I($ox<=>$xx);
  begin_row('va', 'WRAPA');
    C($vx<$xx);C($vx<=$xx);C($vx>$xx);C($vx>=$xx);C($vx==$xx);C($vx===$xx);
    I($vx<=>$xx);
  begin_row('cp', 'WRAPA');
    C($cx<$xx);C($cx<=$xx);C($cx>$xx);C($cx>=$xx);C($cx==$xx);C($cx===$xx);
    I($cx<=>$xx);
  begin_row('ep', 'WRAPA');
    Cx(() ==> $ex<$xx);Cx(() ==> $ex<=$xx);Cx(() ==> $ex>$xx);Cx(() ==> $ex>=$xx);Cx(() ==> $ex==$xx);Cx(() ==> $ex===$xx);
    Ix(() ==> $ex<=>$xx);
  begin_row('lp', 'WRAPA');
    C($lx<$xx);C($lx<=$xx);C($lx>$xx);C($lx>=$xx);C($lx==$xx);C($lx===$xx);
    I($lx<=>$xx);
  begin_row('qp', 'WRAPA');
    C($qx<$xx);C($qx<=$xx);C($qx>$xx);C($qx>=$xx);C($qx==$xx);C($qx===$xx);
    I($qx<=>$xx);

  begin_row('nv', 'WRAPO');
    C($ny<$xy);C($ny<=$xy);C($ny>$xy);C($ny>=$xy);C($ny==$xy);C($ny===$xy);
    I($ny<=>$xy);
  begin_row('tv', 'WRAPO');
    C($ty<$xy);C($ty<=$xy);C($ty>$xy);C($ty>=$xy);C($ty==$xy);C($ty===$xy);
    I($ty<=>$xy);
  begin_row('bv', 'WRAPO');
    C($by<$xy);C($by<=$xy);C($by>$xy);C($by>=$xy);C($by==$xy);C($by===$xy);
    I($by<=>$xy);
  begin_row('iv', 'WRAPO');
    C($iy<$xy);C($iy<=$xy);C($iy>$xy);C($iy>=$xy);C($iy==$xy);C($iy===$xy);
    I($iy<=>$xy);
  begin_row('fv', 'WRAPO');
    C($fy<$xy);C($fy<=$xy);C($fy>$xy);C($fy>=$xy);C($fy==$xy);C($fy===$xy);
    I($fy<=>$xy);
  begin_row('sv', 'WRAPO');
    C($sy<$xy);C($sy<=$xy);C($sy>$xy);C($sy>=$xy);C($sy==$xy);C($sy===$xy);
    I($sy<=>$xy);
  begin_row('rv', 'WRAPO');
    C($ry<$xy);C($ry<=$xy);C($ry>$xy);C($ry>=$xy);C($ry==$xy);C($ry===$xy);
    I($ry<=>$xy);
  begin_row('ov', 'WRAPO');
    C($oy<$xy);C($oy<=$xy);C($oy>$xy);C($oy>=$xy);C($oy==$xy);C($oy===$xy);
    I($oy<=>$xy);
  begin_row('va', 'WRAPO');
    C($vy<$xy);C($vy<=$xy);C($vy>$xy);C($vy>=$xy);C($vy==$xy);C($vy===$xy);
    I($vy<=>$xy);
  begin_row('cp', 'WRAPO');
    C($cy<$xy);C($cy<=$xy);C($cy>$xy);C($cy>=$xy);C($cy==$xy);C($cy===$xy);
    I($cy<=>$xy);
  begin_row('ep', 'WRAPO');
    Cx(() ==> $ey<$xy);Cx(() ==> $ey<=$xy);Cx(() ==> $ey>$xy);Cx(() ==> $ey>=$xy);Cx(() ==> $ey==$xy);Cx(() ==> $ey===$xy);
    Ix(() ==> $ey<=>$xy);
  begin_row('lp', 'WRAPO');
    C($ly<$xy);C($ly<=$xy);C($ly>$xy);C($ly>=$xy);C($ly==$xy);C($ly===$xy);
    I($ly<=>$xy);
  begin_row('qp', 'WRAPO');
    C($qy<$xy);C($qy<=$xy);C($qy>$xy);C($qy>=$xy);C($qy==$xy);C($qy===$xy);
    I($qy<=>$xy);

  begin_row('nv', 'WRAPD');
    C($nz<$xz);C($nz<=$xz);C($nz>$xz);C($nz>=$xz);C($nz==$xz);C($nz===$xz);
    I($nz<=>$xz);
  begin_row('tv', 'WRAPD');
    C($tz<$xz);C($tz<=$xz);C($tz>$xz);C($tz>=$xz);C($tz==$xz);C($tz===$xz);
    I($tz<=>$xz);
  begin_row('bv', 'WRAPD');
    C($bz<$xz);C($bz<=$xz);C($bz>$xz);C($bz>=$xz);C($bz==$xz);C($bz===$xz);
    I($bz<=>$xz);
  begin_row('iv', 'WRAPD');
    C($iz<$xz);C($iz<=$xz);C($iz>$xz);C($iz>=$xz);C($iz==$xz);C($iz===$xz);
    I($iz<=>$xz);
  begin_row('fv', 'WRAPD');
    C($fz<$xz);C($fz<=$xz);C($fz>$xz);C($fz>=$xz);C($fz==$xz);C($fz===$xz);
    I($fz<=>$xz);
  begin_row('sv', 'WRAPD');
    C($sz<$xz);C($sz<=$xz);C($sz>$xz);C($sz>=$xz);C($sz==$xz);C($sz===$xz);
    I($sz<=>$xz);
  begin_row('rv', 'WRAPD');
    C($rz<$xz);C($rz<=$xz);C($rz>$xz);C($rz>=$xz);C($rz==$xz);C($rz===$xz);
    I($rz<=>$xz);
  begin_row('ov', 'WRAPD');
    C($oz<$xz);C($oz<=$xz);C($oz>$xz);C($oz>=$xz);C($oz==$xz);C($oz===$xz);
    I($oz<=>$xz);
  begin_row('va', 'WRAPD');
    C($vz<$xz);C($vz<=$xz);C($vz>$xz);C($vz>=$xz);C($vz==$xz);C($vz===$xz);
    I($vz<=>$xz);
  begin_row('cp', 'WRAPD');
    C($cz<$xz);C($cz<=$xz);C($cz>$xz);C($cz>=$xz);C($cz==$xz);C($cz===$xz);
    I($cz<=>$xz);
  begin_row('ep', 'WRAPD');
    Cx(() ==> $ez<$xz);Cx(() ==> $ez<=$xz);Cx(() ==> $ez>$xz);Cx(() ==> $ez>=$xz);Cx(() ==> $ez==$xz);Cx(() ==> $ez===$xz);
    Ix(() ==> $ez<=>$xz);
  begin_row('lp', 'WRAPD');
    C($lz<$xz);C($lz<=$xz);C($lz>$xz);C($lz>=$xz);C($lz==$xz);C($lz===$xz);
    I($lz<=>$xz);
  begin_row('qp', 'WRAPD');
    C($qz<$xz);C($qz<=$xz);C($qz>$xz);C($qz>=$xz);C($qz==$xz);C($qz===$xz);
    I($qz<=>$xz);
  print_footer();
}

<<__NEVER_INLINE>> function dynamic_compare() {
  $cm = LV(class_meth(Foo::class, 'bar'));
  $nv = LV(null);
  $tv = LV(true);
  $bv = LV(false);
  $iv = LV(42);
  $fv = LV(3.14159);
  $sv = LV('Foo::bar');
  $rv = LV(opendir(getcwd()));
  $ov = LV(new StrObj('Foo::bar'));
  $va = LV(varray[Foo::class, 'bar']);
  $da = LV(darray[0 => Foo::class, 1 => 'bar']);
  $cp = LV(class_meth(Foo::class, 'bar'));
  $ep = LV(bar<>);
  $lp = LV(class_meth(Foo::class, 'baz'));
  $qp = LV(CLS('Foo'));

  $xx = WRAPA($cm); $nx = WRAPA($nv); $tx = WRAPA($tv); $bx = WRAPA($bv);
  $ix = WRAPA($iv); $fx = WRAPA($fv); $sx = WRAPA($sv); $rx = WRAPA($rv);
  $ox = WRAPA($ov); $vx = WRAPA($va); $dx = WRAPA($da); $cx = WRAPA($cp);
  $ex = WRAPA($ep); $lx = WRAPA($lp); $qx = WRAPA($qp);

  $xy = WRAPO($cm); $ny = WRAPO($nv); $ty = WRAPO($tv); $by = WRAPO($bv);
  $iy = WRAPO($iv); $fy = WRAPO($fv); $sy = WRAPO($sv); $ry = WRAPO($rv);
  $oy = WRAPO($ov); $vy = WRAPO($va); $dy = WRAPO($da); $cy = WRAPO($cp);
  $ey = WRAPO($ep); $ly = WRAPO($lp); $qy = WRAPO($qp);

  $xz = WRAPD($cm); $nz = WRAPD($nv); $tz = WRAPD($tv); $bz = WRAPD($bv);
  $iz = WRAPD($iv); $fz = WRAPD($fv); $sz = WRAPD($sv); $rz = WRAPD($rv);
  $oz = WRAPD($ov); $vz = WRAPD($va); $dz = WRAPD($da); $cz = WRAPD($cp);
  $ez = WRAPD($ep); $lz = WRAPD($lp); $qz = WRAPD($qp);

  print_header('[dynamic] $cm ? VAR');
  begin_row('cm');
    C($cm<$cm);C($cm<=$cm);C($cm>$cm);C($cm>=$cm);C($cm==$cm);C($cm===$cm);
    I($cm<=>$cm);
  begin_row('nv');
    C($cm<$nv);C($cm<=$nv);C($cm>$nv);C($cm>=$nv);C($cm==$nv);C($cm===$nv);
    I($cm<=>$nv);
  begin_row('tv');
    C($cm<$tv);C($cm<=$tv);C($cm>$tv);C($cm>=$tv);C($cm==$tv);C($cm===$tv);
    I($cm<=>$tv);
  begin_row('bv');
    C($cm<$bv);C($cm<=$bv);C($cm>$bv);C($cm>=$bv);C($cm==$bv);C($cm===$bv);
    I($cm<=>$bv);
  begin_row('iv');
    C($cm<$iv);C($cm<=$iv);C($cm>$iv);C($cm>=$iv);C($cm==$iv);C($cm===$iv);
    I($cm<=>$iv);
  begin_row('fv');
    C($cm<$fv);C($cm<=$fv);C($cm>$fv);C($cm>=$fv);C($cm==$fv);C($cm===$fv);
    I($cm<=>$fv);
  begin_row('sv');
    C($cm<$sv);C($cm<=$sv);C($cm>$sv);C($cm>=$sv);C($cm==$sv);C($cm===$sv);
    I($cm<=>$sv);
  begin_row('rv');
    C($cm<$rv);C($cm<=$rv);C($cm>$rv);C($cm>=$rv);C($cm==$rv);C($cm===$rv);
    I($cm<=>$rv);
  begin_row('ov');
    C($cm<$ov);C($cm<=$ov);C($cm>$ov);C($cm>=$ov);C($cm==$ov);C($cm===$ov);
    I($cm<=>$ov);
  begin_row('va');
    C($cm<$va);C($cm<=$va);C($cm>$va);C($cm>=$va);C($cm==$va);C($cm===$va);
    I($cm<=>$va);
  begin_row('cp');
    C($cm<$cp);C($cm<=$cp);C($cm>$cp);C($cm>=$cp);C($cm==$cp);C($cm===$cp);
    I($cm<=>$cp);
  begin_row('ep');
    Cx(() ==> $cm<$ep);Cx(() ==> $cm<=$ep);Cx(() ==> $cm>$ep);Cx(() ==> $cm>=$ep);Cx(() ==> $cm==$ep);Cx(() ==> $cm===$ep);
    Ix(() ==> $cm<=>$ep);
  begin_row('lp');
    C($cm<$lp);C($cm<=$lp);C($cm>$lp);C($cm>=$lp);C($cm==$lp);C($cm===$lp);
    I($cm<=>$lp);
  begin_row('qp');
    C($cm<$qp);C($cm<=$qp);C($cm>$qp);C($cm>=$qp);C($cm==$qp);C($cm===$qp);
    I($cm<=>$qp);

  begin_row('nv', 'WRAPA');
    C($xx<$nx);C($xx<=$nx);C($xx>$nx);C($xx>=$nx);C($xx==$nx);C($xx===$nx);
    I($xx<=>$nx);
  begin_row('tv', 'WRAPA');
    C($xx<$tx);C($xx<=$tx);C($xx>$tx);C($xx>=$tx);C($xx==$tx);C($xx===$tx);
    I($xx<=>$tx);
  begin_row('bv', 'WRAPA');
    C($xx<$bx);C($xx<=$bx);C($xx>$bx);C($xx>=$bx);C($xx==$bx);C($xx===$bx);
    I($xx<=>$bx);
  begin_row('iv', 'WRAPA');
    C($xx<$ix);C($xx<=$ix);C($xx>$ix);C($xx>=$ix);C($xx==$ix);C($xx===$ix);
    I($xx<=>$ix);
  begin_row('fv', 'WRAPA');
    C($xx<$fx);C($xx<=$fx);C($xx>$fx);C($xx>=$fx);C($xx==$fx);C($xx===$fx);
    I($xx<=>$fx);
  begin_row('sv', 'WRAPA');
    C($xx<$sx);C($xx<=$sx);C($xx>$sx);C($xx>=$sx);C($xx==$sx);C($xx===$sx);
    I($xx<=>$sx);
  begin_row('rv', 'WRAPA');
    C($xx<$rx);C($xx<=$rx);C($xx>$rx);C($xx>=$rx);C($xx==$rx);C($xx===$rx);
    I($xx<=>$rx);
  begin_row('ov', 'WRAPA');
    C($xx<$ox);C($xx<=$ox);C($xx>$ox);C($xx>=$ox);C($xx==$ox);C($xx===$ox);
    I($xx<=>$ox);
  begin_row('va', 'WRAPA');
    C($xx<$vx);C($xx<=$vx);C($xx>$vx);C($xx>=$vx);C($xx==$vx);C($xx===$vx);
    I($xx<=>$vx);
  begin_row('cp', 'WRAPA');
    C($xx<$cx);C($xx<=$cx);C($xx>$cx);C($xx>=$cx);C($xx==$cx);C($xx===$cx);
    I($xx<=>$cx);
  begin_row('ep', 'WRAPA');
    Cx(() ==> $xx<$ex);Cx(() ==> $xx<=$ex);Cx(() ==> $xx>$ex);Cx(() ==> $xx>=$ex);Cx(() ==> $xx==$ex);Cx(() ==> $xx===$ex);
    Ix(() ==> $xx<=>$ex);
  begin_row('lp', 'WRAPA');
    C($xx<$lx);C($xx<=$lx);C($xx>$lx);C($xx>=$lx);C($xx==$lx);C($xx===$lx);
    I($xx<=>$lx);
  begin_row('qp', 'WRAPA');
    C($xx<$qx);C($xx<=$qx);C($xx>$qx);C($xx>=$qx);C($xx==$qx);C($xx===$qx);
    I($xx<=>$qx);

  begin_row('nv', 'WRAPO');
    C($xy<$ny);C($xy<=$ny);C($xy>$ny);C($xy>=$ny);C($xy==$ny);C($xy===$ny);
    I($xy<=>$ny);
  begin_row('tv', 'WRAPO');
    C($xy<$ty);C($xy<=$ty);C($xy>$ty);C($xy>=$ty);C($xy==$ty);C($xy===$ty);
    I($xy<=>$ty);
  begin_row('bv', 'WRAPO');
    C($xy<$by);C($xy<=$by);C($xy>$by);C($xy>=$by);C($xy==$by);C($xy===$by);
    I($xy<=>$by);
  begin_row('iv', 'WRAPO');
    C($xy<$iy);C($xy<=$iy);C($xy>$iy);C($xy>=$iy);C($xy==$iy);C($xy===$iy);
    I($xy<=>$iy);
  begin_row('fv', 'WRAPO');
    C($xy<$fy);C($xy<=$fy);C($xy>$fy);C($xy>=$fy);C($xy==$fy);C($xy===$fy);
    I($xy<=>$fy);
  begin_row('sv', 'WRAPO');
    C($xy<$sy);C($xy<=$sy);C($xy>$sy);C($xy>=$sy);C($xy==$sy);C($xy===$sy);
    I($xy<=>$sy);
  begin_row('rv', 'WRAPO');
    C($xy<$ry);C($xy<=$ry);C($xy>$ry);C($xy>=$ry);C($xy==$ry);C($xy===$ry);
    I($xy<=>$ry);
  begin_row('ov', 'WRAPO');
    C($xy<$oy);C($xy<=$oy);C($xy>$oy);C($xy>=$oy);C($xy==$oy);C($xy===$oy);
    I($xy<=>$oy);
  begin_row('va', 'WRAPO');
    C($xy<$vy);C($xy<=$vy);C($xy>$vy);C($xy>=$vy);C($xy==$vy);C($xy===$vy);
    I($xy<=>$vy);
  begin_row('cp', 'WRAPO');
    C($xy<$cy);C($xy<=$cy);C($xy>$cy);C($xy>=$cy);C($xy==$cy);C($xy===$cy);
    I($xy<=>$cy);
  begin_row('ep', 'WRAPO');
    Cx(() ==> $xy<$ey);Cx(() ==> $xy<=$ey);Cx(() ==> $xy>$ey);Cx(() ==> $xy>=$ey);Cx(() ==> $xy==$ey);Cx(() ==> $xy===$ey);
    Ix(() ==> $xy<=>$ey);
  begin_row('lp', 'WRAPO');
    C($xy<$ly);C($xy<=$ly);C($xy>$ly);C($xy>=$ly);C($xy==$ly);C($xy===$ly);
    I($xy<=>$ly);
  begin_row('qp', 'WRAPO');
    C($xy<$qy);C($xy<=$qy);C($xy>$qy);C($xy>=$qy);C($xy==$qy);C($xy===$qy);
    I($xy<=>$qy);

  begin_row('nv', 'WRAPD');
    C($xz<$nz);C($xz<=$nz);C($xz>$nz);C($xz>=$nz);C($xz==$nz);C($xz===$nz);
    I($xz<=>$nz);
  begin_row('tv', 'WRAPD');
    C($xz<$tz);C($xz<=$tz);C($xz>$tz);C($xz>=$tz);C($xz==$tz);C($xz===$tz);
    I($xz<=>$tz);
  begin_row('bv', 'WRAPD');
    C($xz<$bz);C($xz<=$bz);C($xz>$bz);C($xz>=$bz);C($xz==$bz);C($xz===$bz);
    I($xz<=>$bz);
  begin_row('iv', 'WRAPD');
    C($xz<$iz);C($xz<=$iz);C($xz>$iz);C($xz>=$iz);C($xz==$iz);C($xz===$iz);
    I($xz<=>$iz);
  begin_row('fv', 'WRAPD');
    C($xz<$fz);C($xz<=$fz);C($xz>$fz);C($xz>=$fz);C($xz==$fz);C($xz===$fz);
    I($xz<=>$fz);
  begin_row('sv', 'WRAPD');
    C($xz<$sz);C($xz<=$sz);C($xz>$sz);C($xz>=$sz);C($xz==$sz);C($xz===$sz);
    I($xz<=>$sz);
  begin_row('rv', 'WRAPD');
    C($xz<$rz);C($xz<=$rz);C($xz>$rz);C($xz>=$rz);C($xz==$rz);C($xz===$rz);
    I($xz<=>$rz);
  begin_row('ov', 'WRAPD');
    C($xz<$oz);C($xz<=$oz);C($xz>$oz);C($xz>=$oz);C($xz==$oz);C($xz===$oz);
    I($xz<=>$oz);
  begin_row('va', 'WRAPD');
    C($xz<$vz);C($xz<=$vz);C($xz>$vz);C($xz>=$vz);C($xz==$vz);C($xz===$vz);
    I($xz<=>$vz);
  begin_row('cp', 'WRAPD');
    C($xz<$cz);C($xz<=$cz);C($xz>$cz);C($xz>=$cz);C($xz==$cz);C($xz===$cz);
    I($xz<=>$cz);
  begin_row('ep', 'WRAPD');
    Cx(() ==> $xz<$ez);Cx(() ==> $xz<=$ez);Cx(() ==> $xz>$ez);Cx(() ==> $xz>=$ez);Cx(() ==> $xz==$ez);Cx(() ==> $xz===$ez);
    Ix(() ==> $xz<=>$ez);
  begin_row('lp', 'WRAPD');
    C($xz<$lz);C($xz<=$lz);C($xz>$lz);C($xz>=$lz);C($xz==$lz);C($xz===$lz);
    I($xz<=>$lz);
  begin_row('qp', 'WRAPD');
    C($xz<$qz);C($xz<=$qz);C($xz>$qz);C($xz>=$qz);C($xz==$qz);C($xz===$qz);
    I($xz<=>$qz);
  print_footer();

  print_header('[dynamic] VAR ? $cm');
  begin_row('cm');
    C($cm<$cm);C($cm<=$cm);C($cm>$cm);C($cm>=$cm);C($cm==$cm);C($cm===$cm);
    I($cm<=>$cm);
  begin_row('nv');
    C($nv<$cm);C($nv<=$cm);C($nv>$cm);C($nv>=$cm);C($nv==$cm);C($nv===$cm);
    I($nv<=>$cm);
  begin_row('tv');
    C($tv<$cm);C($tv<=$cm);C($tv>$cm);C($tv>=$cm);C($tv==$cm);C($tv===$cm);
    I($tv<=>$cm);
  begin_row('bv');
    C($bv<$cm);C($bv<=$cm);C($bv>$cm);C($bv>=$cm);C($bv==$cm);C($bv===$cm);
    I($bv<=>$cm);
  begin_row('iv');
    C($iv<$cm);C($iv<=$cm);C($iv>$cm);C($iv>=$cm);C($iv==$cm);C($iv===$cm);
    I($iv<=>$cm);
  begin_row('fv');
    C($fv<$cm);C($fv<=$cm);C($fv>$cm);C($fv>=$cm);C($fv==$cm);C($fv===$cm);
    I($fv<=>$cm);
  begin_row('sv');
    C($sv<$cm);C($sv<=$cm);C($sv>$cm);C($sv>=$cm);C($sv==$cm);C($sv===$cm);
    I($sv<=>$cm);
  begin_row('rv');
    C($rv<$cm);C($rv<=$cm);C($rv>$cm);C($rv>=$cm);C($rv==$cm);C($rv===$cm);
    I($rv<=>$cm);
  begin_row('ov');
    C($ov<$cm);C($ov<=$cm);C($ov>$cm);C($ov>=$cm);C($ov==$cm);C($ov===$cm);
    I($ov<=>$cm);
  begin_row('va');
    C($va<$cm);C($va<=$cm);C($va>$cm);C($va>=$cm);C($va==$cm);C($va===$cm);
    I($va<=>$cm);
  begin_row('cp');
    C($cp<$cm);C($cp<=$cm);C($cp>$cm);C($cp>=$cm);C($cp==$cm);C($cp===$cm);
    I($cp<=>$cm);
  begin_row('ep');
    Cx(() ==> $ep<$cm);Cx(() ==> $ep<=$cm);Cx(() ==> $ep>$cm);Cx(() ==> $ep>=$cm);Cx(() ==> $ep==$cm);Cx(() ==> $ep===$cm);
    Ix(() ==> $ep<=>$cm);
  begin_row('lp');
    C($lp<$cm);C($lp<=$cm);C($lp>$cm);C($lp>=$cm);C($lp==$cm);C($lp===$cm);
    I($lp<=>$cm);
  begin_row('qp');
    C($qp<$cm);C($qp<=$cm);C($qp>$cm);C($qp>=$cm);C($qp==$cm);C($qp===$cm);
    I($qp<=>$cm);

  begin_row('nv', 'WRAPA');
    C($nx<$xx);C($nx<=$xx);C($nx>$xx);C($nx>=$xx);C($nx==$xx);C($nx===$xx);
    I($nx<=>$xx);
  begin_row('tv', 'WRAPA');
    C($tx<$xx);C($tx<=$xx);C($tx>$xx);C($tx>=$xx);C($tx==$xx);C($tx===$xx);
    I($tx<=>$xx);
  begin_row('bv', 'WRAPA');
    C($bx<$xx);C($bx<=$xx);C($bx>$xx);C($bx>=$xx);C($bx==$xx);C($bx===$xx);
    I($bx<=>$xx);
  begin_row('iv', 'WRAPA');
    C($ix<$xx);C($ix<=$xx);C($ix>$xx);C($ix>=$xx);C($ix==$xx);C($ix===$xx);
    I($ix<=>$xx);
  begin_row('fv', 'WRAPA');
    C($fx<$xx);C($fx<=$xx);C($fx>$xx);C($fx>=$xx);C($fx==$xx);C($fx===$xx);
    I($fx<=>$xx);
  begin_row('sv', 'WRAPA');
    C($sx<$xx);C($sx<=$xx);C($sx>$xx);C($sx>=$xx);C($sx==$xx);C($sx===$xx);
    I($sx<=>$xx);
  begin_row('rv', 'WRAPA');
    C($rx<$xx);C($rx<=$xx);C($rx>$xx);C($rx>=$xx);C($rx==$xx);C($rx===$xx);
    I($rx<=>$xx);
  begin_row('ov', 'WRAPA');
    C($ox<$xx);C($ox<=$xx);C($ox>$xx);C($ox>=$xx);C($ox==$xx);C($ox===$xx);
    I($ox<=>$xx);
  begin_row('va', 'WRAPA');
    C($vx<$xx);C($vx<=$xx);C($vx>$xx);C($vx>=$xx);C($vx==$xx);C($vx===$xx);
    I($vx<=>$xx);
  begin_row('cp', 'WRAPA');
    C($cx<$xx);C($cx<=$xx);C($cx>$xx);C($cx>=$xx);C($cx==$xx);C($cx===$xx);
    I($cx<=>$xx);
  begin_row('ep', 'WRAPA');
    Cx(() ==> $ex<$xx);Cx(() ==> $ex<=$xx);Cx(() ==> $ex>$xx);Cx(() ==> $ex>=$xx);Cx(() ==> $ex==$xx);Cx(() ==> $ex===$xx);
    Ix(() ==> $ex<=>$xx);
  begin_row('lp', 'WRAPA');
    C($lx<$xx);C($lx<=$xx);C($lx>$xx);C($lx>=$xx);C($lx==$xx);C($lx===$xx);
    I($lx<=>$xx);
  begin_row('qp', 'WRAPA');
    C($qx<$xx);C($qx<=$xx);C($qx>$xx);C($qx>=$xx);C($qx==$xx);C($qx===$xx);
    I($qx<=>$xx);

  begin_row('nv', 'WRAPO');
    C($ny<$xy);C($ny<=$xy);C($ny>$xy);C($ny>=$xy);C($ny==$xy);C($ny===$xy);
    I($ny<=>$xy);
  begin_row('tv', 'WRAPO');
    C($ty<$xy);C($ty<=$xy);C($ty>$xy);C($ty>=$xy);C($ty==$xy);C($ty===$xy);
    I($ty<=>$xy);
  begin_row('bv', 'WRAPO');
    C($by<$xy);C($by<=$xy);C($by>$xy);C($by>=$xy);C($by==$xy);C($by===$xy);
    I($by<=>$xy);
  begin_row('iv', 'WRAPO');
    C($iy<$xy);C($iy<=$xy);C($iy>$xy);C($iy>=$xy);C($iy==$xy);C($iy===$xy);
    I($iy<=>$xy);
  begin_row('fv', 'WRAPO');
    C($fy<$xy);C($fy<=$xy);C($fy>$xy);C($fy>=$xy);C($fy==$xy);C($fy===$xy);
    I($fy<=>$xy);
  begin_row('sv', 'WRAPO');
    C($sy<$xy);C($sy<=$xy);C($sy>$xy);C($sy>=$xy);C($sy==$xy);C($sy===$xy);
    I($sy<=>$xy);
  begin_row('rv', 'WRAPO');
    C($ry<$xy);C($ry<=$xy);C($ry>$xy);C($ry>=$xy);C($ry==$xy);C($ry===$xy);
    I($ry<=>$xy);
  begin_row('ov', 'WRAPO');
    C($oy<$xy);C($oy<=$xy);C($oy>$xy);C($oy>=$xy);C($oy==$xy);C($oy===$xy);
    I($oy<=>$xy);
  begin_row('va', 'WRAPO');
    C($vy<$xy);C($vy<=$xy);C($vy>$xy);C($vy>=$xy);C($vy==$xy);C($vy===$xy);
    I($vy<=>$xy);
  begin_row('cp', 'WRAPO');
    C($cy<$xy);C($cy<=$xy);C($cy>$xy);C($cy>=$xy);C($cy==$xy);C($cy===$xy);
    I($cy<=>$xy);
  begin_row('ep', 'WRAPO');
    Cx(() ==> $ey<$xy);Cx(() ==> $ey<=$xy);Cx(() ==> $ey>$xy);Cx(() ==> $ey>=$xy);Cx(() ==> $ey==$xy);Cx(() ==> $ey===$xy);
    Ix(() ==> $ey<=>$xy);
  begin_row('lp', 'WRAPO');
    C($ly<$xy);C($ly<=$xy);C($ly>$xy);C($ly>=$xy);C($ly==$xy);C($ly===$xy);
    I($ly<=>$xy);
  begin_row('qp', 'WRAPO');
    C($qy<$xy);C($qy<=$xy);C($qy>$xy);C($qy>=$xy);C($qy==$xy);C($qy===$xy);
    I($qy<=>$xy);

  begin_row('nv', 'WRAPD');
    C($nz<$xz);C($nz<=$xz);C($nz>$xz);C($nz>=$xz);C($nz==$xz);C($nz===$xz);
    I($nz<=>$xz);
  begin_row('tv', 'WRAPD');
    C($tz<$xz);C($tz<=$xz);C($tz>$xz);C($tz>=$xz);C($tz==$xz);C($tz===$xz);
    I($tz<=>$xz);
  begin_row('bv', 'WRAPD');
    C($bz<$xz);C($bz<=$xz);C($bz>$xz);C($bz>=$xz);C($bz==$xz);C($bz===$xz);
    I($bz<=>$xz);
  begin_row('iv', 'WRAPD');
    C($iz<$xz);C($iz<=$xz);C($iz>$xz);C($iz>=$xz);C($iz==$xz);C($iz===$xz);
    I($iz<=>$xz);
  begin_row('fv', 'WRAPD');
    C($fz<$xz);C($fz<=$xz);C($fz>$xz);C($fz>=$xz);C($fz==$xz);C($fz===$xz);
    I($fz<=>$xz);
  begin_row('sv', 'WRAPD');
    C($sz<$xz);C($sz<=$xz);C($sz>$xz);C($sz>=$xz);C($sz==$xz);C($sz===$xz);
    I($sz<=>$xz);
  begin_row('rv', 'WRAPD');
    C($rz<$xz);C($rz<=$xz);C($rz>$xz);C($rz>=$xz);C($rz==$xz);C($rz===$xz);
    I($rz<=>$xz);
  begin_row('ov', 'WRAPD');
    C($oz<$xz);C($oz<=$xz);C($oz>$xz);C($oz>=$xz);C($oz==$xz);C($oz===$xz);
    I($oz<=>$xz);
  begin_row('va', 'WRAPD');
    C($vz<$xz);C($vz<=$xz);C($vz>$xz);C($vz>=$xz);C($vz==$xz);C($vz===$xz);
    I($vz<=>$xz);
  begin_row('cp', 'WRAPD');
    C($cz<$xz);C($cz<=$xz);C($cz>$xz);C($cz>=$xz);C($cz==$xz);C($cz===$xz);
    I($cz<=>$xz);
  begin_row('ep', 'WRAPD');
    Cx(() ==> $ez<$xz);Cx(() ==> $ez<=$xz);Cx(() ==> $ez>$xz);Cx(() ==> $ez>=$xz);Cx(() ==> $ez==$xz);Cx(() ==> $ez===$xz);
    Ix(() ==> $ez<=>$xz);
  begin_row('lp', 'WRAPD');
    C($lz<$xz);C($lz<=$xz);C($lz>$xz);C($lz>=$xz);C($lz==$xz);C($lz===$xz);
    I($lz<=>$xz);
  begin_row('qp', 'WRAPD');
    C($qz<$xz);C($qz<=$xz);C($qz>$xz);C($qz>=$xz);C($qz==$xz);C($qz===$xz);
    I($qz<=>$xz);
  print_footer();
}

<<__EntryPoint>>
function main() {
  set_error_handler(handle_error<>);
  static_compare();
  dynamic_compare();
}

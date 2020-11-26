create sql view antran_view as
select arinvc.cwhseno AS cwhseno,
	'Factura' AS ctype,
    arinvc.dstar AS dtrndate,
    arinvc.crefno AS crefno,
    arinvc.cinvno AS ctrnno,
    arinvt.cservno AS cservno,
    arinvt.cdesc AS cdesc,
    arinvt.nqty * -1 AS nqty,
    arinvt.ncost AS ncost,
    artcas.cdesc AS cdesctran 
    from arinvc 
    left join arinvt on arinvc.cinvno = arinvt.cinvno
    left join artcas on artcas.cpaycode = arinvc.cpaycode 
     left join arserm on arserm.cservno = arinvt.cservno
     where arserm.lupdateonhand = 1 and arinvc.cstatus = 'OP'
     union all 
     select aradjm.cwhseno as cwhseno,
             'Requisa' AS ctype,
			 aradjm.dtrndate as dtrndate,
             aradjm.crefno as crefno,
             aradjm.cadjno as ctrnno,
             aradjt.cservno as cservno,
             aradjt.cdesc as cdesc,
             aradjt.nqty as nqty,
             aradjt.ncost as ncost,
             arcate.cdesc as cdesctran 
             from aradjm 
             left join aradjt on aradjm.cadjno = aradjt.cadjno
             left join arserm on arserm.cservno = aradjt.cservno
             left join arcate on arcate.ccateno = aradjm.ccateno and arcate.ctypecate = 'A'
             where arserm.lupdateonhand = 1 and aradjm.lvoid = 0 order by 3
             
             
             
             
             
             
             
              select artran_view.cwhseno, arwhse.cdesc, SUM(artran_view.nqty) AS nqty 
					From artran_view
					left outer join arwhse on arwhse.cwhseno = artran_view.cwhseno
					where artran_view.cservno = '$lcservno' group by cwhseno
                    
                    
                    
 "CREATE TEMPORARY TABLE artran_view
                    select arinvc.cwhseno AS cwhseno,
                        'Factura' AS ctype,
                        arinvc.dstar AS dtrndate,
                        arinvc.crefno AS crefno,
                        arinvc.cinvno AS ctrnno,
                        arinvt.cservno AS cservno,
                        arinvt.cdesc AS cdesc,
                        arinvt.nqty * -1 AS nqty,
                        arinvt.ncost AS ncost,
                        artcas.cdesc AS cdesctran 
                    from arinvc 
                    left join arinvt on arinvc.cinvno = arinvt.cinvno
                    left join artcas on artcas.cpaycode = arinvc.cpaycode 
                    left join arserm on arserm.cservno = arinvt.cservno
                    where arserm.lupdateonhand = 1 and arinvc.cstatus = 'OP' and arinvt.cservno ='$lcservno'
                    union all 
                    select aradjm.cwhseno as cwhseno,
                        'Requisa' AS ctype,
                            aradjm.dtrndate as dtrndate,
                                aradjm.crefno as crefno,
                                aradjm.cadjno as ctrnno,
                                aradjt.cservno as cservno,
                                aradjt.cdesc as cdesc,
                                aradjt.nqty as nqty,
                                aradjt.ncost as ncost,
                                arcate.cdesc as cdesctran 
                    from aradjm 
                    left join aradjt on aradjm.cadjno = aradjt.cadjno
                    left join arserm on arserm.cservno = aradjt.cservno
                    left join arcate on arcate.ccateno = aradjm.ccateno and arcate.ctypecate = 'A'
                    where arserm.lupdateonhand = 1 and aradjm.lvoid = 0 and aradjt.cservno ='$lcservno' order by 3; 

             select artran_view.cwhseno, arwhse.cdesc, SUM(artran_view.nqty) AS nqty 
					From artran_view
					left outer join arwhse on arwhse.cwhseno = artran_view.cwhseno
					where artran_view.cservno = '$lcservno' group by cwhseno ";	
                   
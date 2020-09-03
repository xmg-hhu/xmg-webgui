
type CAT = {s,np,vp,v,pp}
type MARK = {subst,anchor,foot}
type FS !
type VAR !

property mark : MARK

feature cat : CAT
feature top : FS
feature bot : FS
feature i : VAR
feature e : VAR
feature path : VAR

frame-types = {bounded-translocation}
frame-constraints = {bounded-translocation -> bounded-translocation}

class DirPrepObj
export ?V ?X0
declare ?VP1 ?VP2 ?PP ?V ?X0 ?X1 ?X2 ?X3
{
    <syn>{
	node ?VP1 [cat = vp,bot=[path=?X3] ]{
		node ?VP2 [cat = vp,bot=[path=?X3] ]{        	
			node ?V (mark=anchor)[cat=v]}
		node ?PP (mark=subst)[cat=pp,top=[i=?X1,e=?X0] ]
	}
    };
    <frame>{
        ?X0[bounded-translocation,
            goal:?X1,
            path:?X3
           ]

    };
    <iface>{
      [e=?X0]
    }
}

value DirPrepObj
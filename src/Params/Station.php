<?php

/**
 * This class was autogenerated
 * Do NOT edit
 */

declare(strict_types=1);

namespace Pedros80\TfLphp\Params;

use Pedros80\TfLphp\Exceptions\InvalidStationCode;

final class Station
{
    private const VALID = [
        'HUBABW'       => 'Abbey Wood',
        '910GACTNCTL'  => 'Acton Central',
        '910GACTONML'  => 'Acton Main Line',
        '910GANERLEY'  => 'Anerley',
        '910GBCKNHMH'  => 'Beckenham Hill',
        '910GBELNGHM'  => 'Bellingham',
        '910GBHILLPK'  => 'Bush Hill Park',
        '910GBICKLEY'  => 'Bickley',
        '910GBNHAM'    => 'Burnham',
        '910GBRBY'     => 'Brondesbury',
        '910GBRBYPK'   => 'Brondesbury Park',
        '910GBROCKLY'  => 'Brockley',
        '910GBROMLYS'  => 'Bromley South',
        '910GBRTWOOD'  => 'Brentwood',
        '910GBRUCGRV'  => 'Bruce Grove',
        '910GBTHNLGR'  => 'Bethnal Green',
        '910GCAMHTH'   => 'Cambridge Heath',
        '910GCATFORD'  => 'Catford',
        '910GCFPK'     => 'Crofton Park',
        '910GCHDWLHT'  => 'Chadwell Heath',
        '910GCHESHNT'  => 'Cheshunt',
        '910GCHINGFD'  => 'Chingford',
        '910GCLAPTON'  => 'Clapton',
        '910GCLDNNRB'  => 'Caledonian Road & Barnsbury',
        '910GCLPHHS'   => 'Clapham High Street',
        '910GCMDNRD'   => 'Camden Road',
        '910GCNNB'     => 'Canonbury',
        '910GCOLSDNS'  => 'Coulsdon South',
        '910GCRKLWD'   => 'Cricklewood',
        '910GCRLN'     => 'Charlton',
        '910GCROUCHH'  => 'Crouch Hill',
        '910GCRPNDPK'  => 'Carpenders Park',
        '910GCRSHLTN'  => 'Carshalton',
        '910GCTMSLNK'  => 'City Thameslink',
        '910GDALS'     => 'Dalston Junction',
        '910GDALSKLD'  => 'Dalston Kingsland',
        '910GDARTFD'   => 'Dartford',
        '910GDENMRKH'  => 'Denmark Hill',
        '910GDEPTFD'   => 'Deptford',
        '910GEDMNGRN'  => 'Edmonton Green',
        '910GELTR'     => 'Elstree & Borehamwood',
        '910GEMRSPKH'  => 'Emerson Park',
        '910GENFLDTN'  => 'Enfield Town',
        '910GESTFLDS'  => 'Mitcham Eastfields',
        '910GFNCHLYR'  => 'Finchley Road & Frognal',
        '910GFORESTH'  => 'Forest Hill',
        '910GFRSTGT'   => 'Forest Gate',
        '910GGIDEAPK'  => 'Gidea Park',
        '910GGODMAYS'  => 'Goodmayes',
        '910GGOSPLOK'  => 'Gospel Oak',
        '910GHACKNYC'  => 'Hackney Central',
        '910GHACKNYW'  => 'Hackney Wick',
        '910GHAGGERS'  => 'Haggerston',
        '910GHAKNYNM'  => 'Hackney Downs',
        '910GHANWELL'  => 'Hanwell',
        '910GHAYESAH'  => 'Hayes & Harlington',
        '910GHDON'     => 'Hendon',
        '910GHEDSTNL'  => 'Headstone Lane',
        '910GHERNEH'   => 'Herne Hill',
        '910GHGHMSPK'  => 'Highams Park',
        '910GHKBG'     => 'Hackbridge',
        '910GHMPSTDH'  => 'Hampstead Heath',
        '910GHOMRTON'  => 'Homerton',
        '910GHONROPK'  => 'Honor Oak Park',
        '910GHOXTON'   => 'Hoxton',
        '910GHRGYGL'   => 'Harringay Green Lanes',
        '910GHRLDWOD'  => 'Harold Wood',
        '910GHTCHEND'  => 'Hatch End',
        '910GHYDNSRD'  => 'Haydons Road',
        '910GILFORD'   => 'Ilford',
        '910GIVER'     => 'Iver',
        '910GKENR'     => 'Kensal Rise',
        '910GKLBRNHR'  => 'Kilburn High Road',
        '910GKNTSHTW'  => 'Kentish Town West',
        '910GLANGLEY'  => 'Langley',
        '910GLBGHJN'   => 'Loughborough Junction',
        '910GLEYTNMR'  => 'Leyton Midland Road',
        '910GLONFLDS'  => 'London Fields',
        '910GLYTNSHR'  => 'Leytonstone High Road',
        '910GMANRPK'   => 'Manor Park',
        '910GMAZEH'    => 'Maze Hill',
        '910GMDNHEAD'  => 'Maidenhead',
        '910GMLHB'     => 'Mill Hill Broadway',
        '910GMORDENS'  => 'Morden South',
        '910GMRYLAND'  => 'Maryland',
        '910GNBARNET'  => 'New Barnet',
        '910GNEWSGAT'  => 'New Southgate',
        '910GNUNHEAD'  => 'Nunhead',
        '910GOKLGHPK'  => 'Oakleigh Park',
        '910GORPNGTN'  => 'Orpington',
        '910GPCKHMQD'  => 'Queens Road Peckham',
        '910GPCKHMRY'  => 'Peckham Rye',
        '910GPENEW'    => 'Penge West',
        '910GPETSWD'   => 'Petts Wood',
        '910GPLMS'     => 'Plumstead',
        '910GPURLEY'   => 'Purley',
        '910GRBRN'     => 'Ravensbourne',
        '910GRCTRYRD'  => 'Rectory Road',
        '910GRDNGSTN'  => 'Reading',
        '910GROMFORD'  => 'Romford',
        '910GRTHERHI'  => 'Rotherhithe',
        '910GSACTON'   => 'South Acton',
        '910GSBURY'    => 'Southbury',
        '910GSCROYDN'  => 'South Croydon',
        '910GSHENFLD'  => 'Shenfield',
        '910GSHLIER'   => 'St Helier (London)',
        '910GSHMPSTD'  => 'South Hampstead',
        '910GSHRDHST'  => 'Shoreditch High Street',
        '910GSHRTLND'  => 'Shortlands',
        '910GSIVRST'   => 'Silver Street',
        '910GSLADEGN'  => 'Slade Green',
        '910GSLOUGH'   => 'Slough',
        '910GSMERTON'  => 'South Merton',
        '910GSTHALL'   => 'Southall',
        '910GSTJMSST'  => 'St James Street',
        '910GSTKNWNG'  => 'Stoke Newington',
        '910GSTMFDHL'  => 'Stamford Hill',
        '910GSTMRYC'   => 'St Mary Cray',
        '910GSTOTNHM'  => 'South Tottenham',
        '910GSTRETHM'  => 'Streatham',
        '910GSURREYQ'  => 'Surrey Quays',
        '910GSUTTON'   => 'Sutton',
        '910GSUTTONC'  => 'Sutton Common',
        '910GSVNKNGS'  => 'Seven Kings',
        '910GSWLY'     => 'Swanley',
        '910GTAPLOW'   => 'Taplow',
        '910GTHBLDSG'  => 'Theobalds Grove',
        '910GTOOTING'  => 'Tooting',
        '910GTULSEH'   => 'Tulse Hill',
        '910GTURKYST'  => 'Turkey Street',
        '910GTWYFORD'  => 'Twyford',
        '910GUPRHLWY'  => 'Upper Holloway',
        '910GWAPPING'  => 'Wapping',
        '910GWATFDHS'  => 'Watford High Street',
        '910GWCOMBEP'  => 'Westcombe Park',
        '910GWDGRNPK'  => 'Woodgrange Park',
        '910GWDRYTON'  => 'West Drayton',
        '910GWDST'     => 'Wood Street',
        '910GWEALING'  => 'West Ealing',
        '910GWHHRTLA'  => 'White Hart Lane',
        '910GWHMDSTD'  => 'West Hampstead',
        '910GWHMPSTM'  => 'West Hampstead Thameslink',
        '910GWIMLCHS'  => 'Wimbledon Chase',
        '910GWLTHQRD'  => 'Walthamstow Queen\'s Road',
        '910GWNDSWRD'  => 'Wandsworth Road',
        '910GWNSTDPK'  => 'Wanstead Park',
        '910GWSUTTON'  => 'West Sutton',
        '940GZZALGWP'  => 'IFS Cloud Greenwich Peninsula',
        '940GZZALRDK'  => 'IFS Cloud Royal Docks',
        '940GZZCRADD'  => 'Addiscombe',
        '940GZZCRADV'  => 'Addington Village',
        '940GZZCRAMP'  => 'Ampere Way',
        '940GZZCRARA'  => 'Arena',
        '940GZZCRAVE'  => 'Avenue Road',
        '940GZZCRBED'  => 'Beddington Lane',
        '940GZZCRBGV'  => 'Belgrave Walk',
        '940GZZCRBLA'  => 'Blackhorse Lane',
        '940GZZCRBRD'  => 'Beckenham Road',
        '940GZZCRCEN'  => 'George Street',
        '940GZZCRCHR'  => 'Church Street',
        '940GZZCRCOO'  => 'Coombe Lane',
        '940GZZCRCTR'  => 'Centrale',
        '940GZZCRDDR'  => 'Dundonald Road',
        '940GZZCRFLD'  => 'Fieldway',
        '940GZZCRGRA'  => 'Gravel Hill',
        '940GZZCRHAR'  => 'Harrington Road',
        '940GZZCRKGH'  => 'King Henry\'s Drive',
        '940GZZCRLEB'  => 'Lebanon Road',
        '940GZZCRLOY'  => 'Lloyd Park',
        '940GZZCRMCH'  => 'Mitcham',
        '940GZZCRMDN'  => 'Morden Road',
        '940GZZCRMTP'  => 'Merton Park',
        '940GZZCRNWA'  => 'New Addington',
        '940GZZCRPHI'  => 'Phipps Bridge',
        '940GZZCRRVC'  => 'Reeves Corner',
        '940GZZCRSAN'  => 'Sandilands',
        '940GZZCRTPA'  => 'Therapia Lane',
        '940GZZCRWAD'  => 'Waddon Marsh',
        '940GZZCRWAN'  => 'Wandle Park',
        '940GZZCRWEL'  => 'Wellesley Road',
        '940GZZCRWOD'  => 'Woodside',
        '940GZZDLABR'  => 'Abbey Road',
        '940GZZDLALL'  => 'All Saints',
        '940GZZDLBEC'  => 'Beckton',
        '940GZZDLBLA'  => 'Blackwall',
        '940GZZDLBOW'  => 'Bow Church',
        '940GZZDLBPK'  => 'Beckton Park',
        '940GZZDLCLA'  => 'Crossharbour',
        'HUBCUS'       => 'Custom House for ExCel',
        '940GZZDLCYP'  => 'Cyprus',
        '940GZZDLDEP'  => 'Deptford Bridge',
        '940GZZDLDEV'  => 'Devons Road',
        '940GZZDLEIN'  => 'East India',
        '940GZZDLELV'  => 'Elverson Road',
        '940GZZDLGAL'  => 'Gallions Reach',
        '940GZZDLHEQ'  => 'Heron Quays',
        '940GZZDLISL'  => 'Island Gardens',
        '940GZZDLKGV'  => 'King George V',
        '940GZZDLLDP'  => 'Langdon Park',
        '940GZZDLMUD'  => 'Mudchute',
        '940GZZDLPDK'  => 'Pontoon Dock',
        '940GZZDLPOP'  => 'Poplar',
        '940GZZDLPRE'  => 'Prince Regent',
        '940GZZDLPUD'  => 'Pudding Mill Lane',
        '940GZZDLRAL'  => 'Royal Albert',
        '940GZZDLRVC'  => 'Royal Victoria',
        '940GZZDLSHS'  => 'Stratford High Street',
        '940GZZDLSIT'  => 'Stratford International',
        '940GZZDLSOQ'  => 'South Quay',
        '940GZZDLSTL'  => 'Star Lane',
        '940GZZDLWFE'  => 'Westferry',
        '940GZZDLWIQ'  => 'West India Quay',
        '940GZZDLWSV'  => 'West Silvertown',
        '940GZZLUACT'  => 'Acton Town',
        '940GZZLUACY'  => 'Archway',
        '940GZZLUADE'  => 'Aldgate East',
        '940GZZLUAGL'  => 'Angel',
        '940GZZLUALD'  => 'Aldgate',
        '940GZZLUALP'  => 'Alperton',
        '940GZZLUASG'  => 'Arnos Grove',
        '940GZZLUASL'  => 'Arsenal',
        '940GZZLUBBB'  => 'Bromley-by-Bow',
        '940GZZLUBBN'  => 'Barbican',
        '940GZZLUBDS'  => 'Bounds Green',
        '940GZZLUBEC'  => 'Becontree',
        '940GZZLUBKE'  => 'Barkingside',
        '940GZZLUBKH'  => 'Buckhurst Hill',
        '940GZZLUBLG'  => 'Bethnal Green',
        '940GZZLUBMY'  => 'Bermondsey',
        'HUBBDS'       => 'Bond Street',
        '940GZZLUBOR'  => 'Borough',
        '940GZZLUBOS'  => 'Boston Manor',
        '940GZZLUBSC'  => 'Barons Court',
        '940GZZLUBST'  => 'Baker Street',
        '940GZZLUBTK'  => 'Burnt Oak',
        '940GZZLUBTX'  => 'Brent Cross',
        '940GZZLUBWR'  => 'Bow Road',
        '940GZZLUBWT'  => 'Bayswater',
        '940GZZLUBZP'  => 'Belsize Park',
        '940GZZLUCAR'  => 'Caledonian Road',
        '940GZZLUCFM'  => 'Chalk Farm',
        '940GZZLUCGN'  => 'Covent Garden',
        '940GZZLUCHL'  => 'Chancery Lane',
        '940GZZLUCKS'  => 'Cockfosters',
        '940GZZLUCND'  => 'Colindale',
        '940GZZLUCPC'  => 'Clapham Common',
        '940GZZLUCPK'  => 'Canons Park',
        '940GZZLUCPN'  => 'Clapham North',
        '940GZZLUCPS'  => 'Clapham South',
        '940GZZLUCSD'  => 'Colliers Wood',
        '940GZZLUCSM'  => 'Chesham',
        '940GZZLUCTN'  => 'Camden Town',
        '940GZZLUCWL'  => 'Chigwell',
        '940GZZLUCWP'  => 'Chiswick Park',
        '940GZZLUCXY'  => 'Croxley',
        '940GZZLUDBN'  => 'Debden',
        '940GZZLUDGE'  => 'Dagenham East',
        '940GZZLUDGY'  => 'Dagenham Heathway',
        '940GZZLUDOH'  => 'Dollis Hill',
        '940GZZLUEAE'  => 'Eastcote',
        '940GZZLUEAN'  => 'East Acton',
        '940GZZLUECM'  => 'Ealing Common',
        '940GZZLUECT'  => 'Earl\'s Court',
        '940GZZLUEFY'  => 'East Finchley',
        '940GZZLUEGW'  => 'Edgware',
        '940GZZLUEHM'  => 'East Ham',
        '940GZZLUEMB'  => 'Embankment',
        '940GZZLUEPG'  => 'Epping',
        '940GZZLUEPK'  => 'Elm Park',
        '940GZZLUEPY'  => 'East Putney',
        '940GZZLUERB'  => 'Edgware Road',
        '940GZZLUERC'  => 'Edgware Road',
        '940GZZLUESQ'  => 'Euston Square',
        '940GZZLUFBY'  => 'Fulham Broadway',
        '940GZZLUFLP'  => 'Fairlop',
        '940GZZLUFYC'  => 'Finchley Central',
        '940GZZLUFYR'  => 'Finchley Road',
        '940GZZLUGDG'  => 'Goodge Street',
        '940GZZLUGGH'  => 'Grange Hill',
        '940GZZLUGGN'  => 'Golders Green',
        '940GZZLUGHK'  => 'Goldhawk Road',
        '940GZZLUGPK'  => 'Green Park',
        '940GZZLUGPS'  => 'Great Portland Street',
        '940GZZLUGTH'  => 'Gants Hill',
        '940GZZLUGTR'  => 'Gloucester Road',
        '940GZZLUHBN'  => 'Holborn',
        '940GZZLUHBT'  => 'High Barnet',
        '940GZZLUHCH'  => 'Hornchurch',
        '940GZZLUHCL'  => 'Hendon Central',
        '940GZZLUHGD'  => 'Hillingdon',
        '940GZZLUHGR'  => 'Hanger Lane',
        '940GZZLUHGT'  => 'Highgate',
        '940GZZLUHLT'  => 'Hainault',
        '940GZZLUHNX'  => 'Hatton Cross',
        '940GZZLUHPC'  => 'Hyde Park Corner',
        '940GZZLUHPK'  => 'Holland Park',
        '940GZZLUHSK'  => 'High Street Kensington',
        '940GZZLUHTD'  => 'Hampstead',
        '940GZZLUHWC'  => 'Hounslow Central',
        '940GZZLUHWE'  => 'Hounslow East',
        '940GZZLUHWT'  => 'Hounslow West',
        '940GZZLUHWY'  => 'Holloway Road',
        '940GZZLUICK'  => 'Ickenham',
        '940GZZLUKBN'  => 'Kilburn',
        '940GZZLUKBY'  => 'Kingsbury',
        '940GZZLUKNB'  => 'Knightsbridge',
        '940GZZLUKNG'  => 'Kennington',
        '940GZZLUKPK'  => 'Kilburn Park',
        '940GZZLULAD'  => 'Ladbroke Grove',
        '940GZZLULBN'  => 'Lambeth North',
        '940GZZLULGN'  => 'Loughton',
        '940GZZLULGT'  => 'Lancaster Gate',
        '940GZZLULRD'  => 'Latimer Road',
        '940GZZLULSQ'  => 'Leicester Square',
        '940GZZLULYN'  => 'Leyton',
        '940GZZLULYS'  => 'Leytonstone',
        '940GZZLUMBA'  => 'Marble Arch',
        '940GZZLUMDN'  => 'Morden',
        '940GZZLUMED'  => 'Mile End',
        '940GZZLUMHL'  => 'Mill Hill East',
        '940GZZLUMMT'  => 'Monument',
        '940GZZLUMPK'  => 'Moor Park',
        '940GZZLUMRH'  => 'Manor House',
        '940GZZLUMSH'  => 'Mansion House',
        '940GZZLUMTC'  => 'Mornington Crescent',
        '940GZZLUMVL'  => 'Maida Vale',
        '940GZZLUNAN'  => 'North Acton',
        '940GZZLUNBP'  => 'Newbury Park',
        '940GZZLUNDN'  => 'Neasden',
        '940GZZLUNEN'  => 'North Ealing',
        '940GZZLUNFD'  => 'Northfields',
        '940GZZLUNGW'  => 'North Greenwich',
        '940GZZLUNHA'  => 'North Harrow',
        '940GZZLUNHG'  => 'Notting Hill Gate',
        '940GZZLUNHT'  => 'Northolt',
        '940GZZLUNKP'  => 'Northwick Park',
        '940GZZLUNOW'  => 'Northwood',
        '940GZZLUNWH'  => 'Northwood Hills',
        '940GZZLUOAK'  => 'Oakwood',
        '940GZZLUOSY'  => 'Osterley',
        '940GZZLUOVL'  => 'Oval',
        '940GZZLUOXC'  => 'Oxford Circus',
        '940GZZLUPCC'  => 'Piccadilly Circus',
        '940GZZLUPCO'  => 'Pimlico',
        '940GZZLUPKR'  => 'Park Royal',
        '940GZZLUPLW'  => 'Plaistow',
        '940GZZLUPNR'  => 'Pinner',
        '940GZZLUPRD'  => 'Preston Road',
        '940GZZLUPSG'  => 'Parsons Green',
        '940GZZLUPVL'  => 'Perivale',
        '940GZZLUPYB'  => 'Putney Bridge',
        '940GZZLUQBY'  => 'Queensbury',
        '940GZZLUQWY'  => 'Queensway',
        '940GZZLURBG'  => 'Redbridge',
        '940GZZLURGP'  => 'Regent\'s Park',
        '940GZZLURSG'  => 'Ruislip Gardens',
        '940GZZLURSM'  => 'Ruislip Manor',
        '940GZZLURSP'  => 'Ruislip',
        '940GZZLURSQ'  => 'Russell Square',
        '940GZZLURVP'  => 'Ravenscourt Park',
        '940GZZLURVY'  => 'Roding Valley',
        '940GZZLURYL'  => 'Rayners Lane',
        '940GZZLURYO'  => 'Royal Oak',
        '940GZZLUSBM'  => 'Shepherd\'s Bush Market',
        '940GZZLUSEA'  => 'South Ealing',
        '940GZZLUSFB'  => 'Stamford Brook',
        '940GZZLUSFS'  => 'Southfields',
        '940GZZLUSGN'  => 'Stepney Green',
        '940GZZLUSGT'  => 'Southgate',
        '940GZZLUSHH'  => 'South Harrow',
        '940GZZLUSJP'  => 'St James\'s Park',
        '940GZZLUSJW'  => 'St John\'s Wood',
        '940GZZLUSKS'  => 'South Kensington',
        '940GZZLUSKW'  => 'Stockwell',
        '940GZZLUSNB'  => 'Snaresbrook',
        '940GZZLUSPU'  => 'St Paul\'s',
        '940GZZLUSSQ'  => 'Sloane Square',
        '940GZZLUSTM'  => 'Stanmore',
        '940GZZLUSUH'  => 'Sudbury Hill',
        '940GZZLUSUT'  => 'Sudbury Town',
        '940GZZLUSWC'  => 'Swiss Cottage',
        '940GZZLUSWF'  => 'South Woodford',
        '940GZZLUSWK'  => 'Southwark',
        '940GZZLUSWN'  => 'South Wimbledon',
        '940GZZLUTAW'  => 'Totteridge & Whetstone',
        '940GZZLUTBC'  => 'Tooting Bec',
        '940GZZLUTBY'  => 'Tooting Broadway',
        '940GZZLUTFP'  => 'Tufnell Park',
        '940GZZLUTHB'  => 'Theydon Bois',
        '940GZZLUTMP'  => 'Temple',
        '940GZZLUTNG'  => 'Turnham Green',
        '940GZZLUTPN'  => 'Turnpike Lane',
        '940GZZLUTWH'  => 'Tower Hill',
        '940GZZLUUPB'  => 'Upminster Bridge',
        '940GZZLUUPK'  => 'Upton Park',
        '940GZZLUUPY'  => 'Upney',
        '940GZZLUUXB'  => 'Uxbridge',
        '940GZZLUWAF'  => 'Watford',
        '940GZZLUWCY'  => 'White City',
        '940GZZLUWFN'  => 'West Finchley',
        '940GZZLUWHP'  => 'West Hampstead',
        '940GZZLUWHW'  => 'West Harrow',
        '940GZZLUWIG'  => 'Willesden Green',
        '940GZZLUWIP'  => 'Wimbledon Park',
        '940GZZLUWKA'  => 'Warwick Avenue',
        '940GZZLUWKN'  => 'West Kensington',
        '940GZZLUWLA'  => 'Wood Lane',
        '940GZZLUWOF'  => 'Woodford',
        '940GZZLUWOG'  => 'Wood Green',
        '940GZZLUWOP'  => 'Woodside Park',
        '940GZZLUWRR'  => 'Warren Street',
        '940GZZLUWSD'  => 'Wanstead',
        '940GZZLUWSP'  => 'Westbourne Park',
        '940GZZLUWTA'  => 'West Acton',
        '940GZZLUWYP'  => 'Wembley Park',
        'HUBAMR'       => 'Amersham',
        'HUBBAL'       => 'Balham',
        'HUBBAN'       => 'Bank',
        'HUBBEK'       => 'Beckenham Junction',
        'HUBBFR'       => 'Blackfriars',
        'HUBBHO'       => 'Blackhorse Road',
        'HUBBIR'       => 'Birkbeck',
        'HUBBKG'       => 'Barking',
        'HUBBRX'       => 'Brixton',
        'HUBBSH'       => 'Bushey',
        'HUBCAN'       => 'Canning Town',
        'HUBCAW'       => 'Canary Wharf',
        'HUBCFO'       => 'Chalfont & Latimer',
        'HUBCHX'       => 'Charing Cross',
        'HUBCLJ'       => 'Clapham Junction',
        'HUBCLW'       => 'Chorleywood',
        'HUBCST'       => 'Cannon Street',
        'HUBCUT'       => 'Cutty Sark for Maritime Greenwich',
        'HUBCYP'       => 'Crystal Palace',
        'HUBEAL'       => 'Ealing Broadway',
        'HUBECY'       => 'East Croydon',
        'HUBELM'       => 'Elmers End',
        'HUBEPH'       => 'Elephant & Castle',
        'HUBEUS'       => 'Euston',
        'HUBFPK'       => 'Finsbury Park',
        'HUBGFD'       => 'Greenford',
        'HUBGNW'       => 'Greenwich',
        'HUBGUN'       => 'Gunnersbury',
        'HUBH13'       => 'Heathrow Terminals 2 & 3',
        'HUBHDN'       => 'Harlesden',
        'HUBHHY'       => 'Highbury & Islington',
        'HUBHMS'       => 'Hammersmith',
        'HUBHOH'       => 'Harrow-on-the-Hill',
        'HUBHRW'       => 'Harrow & Wealdstone',
        'HUBHX4'       => 'Heathrow Terminal 4',
        'HUBHX5'       => 'Heathrow Terminal 5',
        'HUBIMP'       => 'Imperial Wharf',
        'HUBKGX'       => 'King\'s Cross St Pancras',
        'HUBKNL'       => 'Kensal Green',
        'HUBKNT'       => 'Kenton',
        'HUBKPA'       => 'Kensington (Olympia)',
        'HUBKTN'       => 'Kentish Town',
        'HUBKWG'       => 'Kew Gardens',
        'HUBLBG'       => 'London Bridge',
        'HUBLCY'       => 'London City Airport',
        'HUBLEW'       => 'Lewisham',
        'HUBLHS'       => 'Limehouse',
        'HUBLST'       => 'Liverpool Street',
        'HUBMJT'       => 'Mitcham Junction',
        'HUBMYB'       => 'Marylebone',
        'HUBNWB'       => 'North Wembley',
        'HUBNWD'       => 'Norwood Junction',
        'HUBNWX'       => 'New Cross',
        'HUBNXG'       => 'New Cross Gate',
        'HUBOLD'       => 'Old Street',
        'HUBPAD'       => 'Paddington',
        'HUBQPW'       => 'Queen\'s Park',
        'HUBRIC'       => 'Rickmansworth',
        'HUBRMD'       => 'Richmond',
        'HUBSBP'       => 'Stonebridge Park',
        'HUBSDE'       => 'Shadwell',
        'HUBSOK'       => 'South Kenton',
        'HUBSPB'       => 'Shepherd\'s Bush',
        'HUBSRA'       => 'Stratford',
        'HUBSRU'       => 'South Ruislip',
        'HUBSVS'       => 'Seven Sisters',
        'HUBSYD'       => 'Sydenham',
        'HUBTCR'       => 'Tottenham Court Road',
        'HUBTOG'       => 'Tower Gateway',
        'HUBTOM'       => 'Tottenham Hale',
        'HUBUPM'       => 'Upminster',
        'HUBVIC'       => 'Victoria',
        'HUBVXH'       => 'Vauxhall',
        'HUBWAT'       => 'Waterloo',
        'HUBWBP'       => 'West Brompton',
        'HUBWCY'       => 'West Croydon',
        'HUBWEH'       => 'West Ham',
        'HUBWFJ'       => 'Watford Junction',
        'HUBWHC'       => 'Walthamstow Central',
        'HUBWIJ'       => 'Willesden Junction',
        'HUBWIM'       => 'Wimbledon',
        'HUBWMB'       => 'Wembley Central',
        'HUBWRU'       => 'West Ruislip',
        'HUBWSM'       => 'Westminster',
        'HUBWWA'       => 'Woolwich Arsenal',
        'HUBZCW'       => 'Canada Water',
        'HUBZFD'       => 'Farringdon',
        'HUBZMG'       => 'Moorgate',
        'HUBZWL'       => 'Whitechapel',
        '940GZZNEUGST' => 'Nine Elms',
        '940GZZBPSUST' => 'Battersea Power Station',
        '910GWOLWXR'   => 'Woolwich',
        '910GBKRVS'    => 'Barking Riverside',
    ];

    public function __construct(
        private string $code,
    ) {
        if (!in_array($code, array_keys(self::VALID))) {
            throw InvalidStationCode::fromCode($code);
        }
    }

    public function __toString(): string
    {
        return $this->code;
    }

    public function name(): string
    {
        return self::VALID[$this->code];
    }
}

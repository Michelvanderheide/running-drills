// Generated by typings
interface TransitionType {
  ENTER: number;
  EXIT: number;
  BOTH: number;
}

interface Window {
  geofence: RunningDrillsPlugin;
  TransitionType: TransitionType;
}

interface RunningDrillsPlugin {
  initialize(
    successCallback?: (result: any) => void,
    errorCallback?: (error: string) => void
  ): Promise<any>;

  addOrUpdate(
    geofence: TrainingSession | TrainingSession[],
    successCallback?: (result: any) => void,
    errorCallback?: (error: string) => void
  ): Promise<any>;

  remove(
    id: number | number[],
    successCallback?: (result: any) => void,
    errorCallback?: (error: string) => void
  ): Promise<any>;

  removeAll(
    successCallback?: (result: any) => void,
    errorCallback?: (error: string) => void
  ): Promise<any>;

  getWatched(
    successCallback?: (result: any) => void,
    errorCallback?: (error: string) => void
  ): Promise<string>;

  onTransitionReceived: (trainingSession: TrainingSession[]) => void;
}


interface TrainingSession {
  id: string;
  description: string;
  drills: Drill[];
  groups: Group[];
}

interface Group {
  groupName: string;
  drills: Drill[];
}

interface Drill {
  id: string;
  title: string;
  description: string;
  imgUrl: string;
  locations: string;
  tags: string;
  orderBy: number;
}


/*
$drills[4] = array(  
  id => 4,
  title => 'Tripplings met kniehef(vasthouden)',
  description => "Tripplings op de plaats met kniehef, kniehef paar sec. vasthouden.",
  tags => array( "warming up", "loopscholing" ),
  locations => array( "circle"),
  musclegroups=> array( ) ) ;


$trainings['20160914']['description'] = "Veel kort werk vanavond. Extra aandacht voor core stability";
$trainings['20160914']['date'] = "2016-09-14";
$trainings['20160914']['drillMappings'][]["warming up"] = array (1);
$trainings['20160914']['drillMappings'][]["circle"] = array (2, 3);
*/
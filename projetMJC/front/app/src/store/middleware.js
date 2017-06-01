/*
 * Npm import
 */
import axios from 'axios';
import moment from 'moment';
import 'moment/locale/fr';

/*
 * Local import
 */
import { CHANGE_DATE, setActivities } from './reducer';
/*
 * Types
 */
const LOAD_ACTIVITIES = 'LOAD_ACTIVITIES';

/*
 * Code
 */
const createMiddleware = store => next => (action) => {
  switch (action.type) {
    case LOAD_ACTIVITIES:
      {
        // console.log(action.currentDate.format());
        // console.error(moment().format());
        let CheminComplet = document.location.href;
        if (CheminComplet.substr(CheminComplet.length - 1, 1) !== '/') {
          CheminComplet += '/';
        }
        // On fait une requête ajax pour récupérer les infos de l'utilisateur +
        // On fait une requête ajax pour récupérer les activités lié à la date et à (l'utilisateur)
        CheminComplet += 'ajax';
        /*axios.post(CheminComplet, {
          date: action.currentDate.format(),
        })
        .then((response) => {
          console.info(response);
          //console.log(response.data.activities);
          store.dispatch(setActivities(response.data.activities));
        })
        .catch((error) => {
          console.error(error);
        });
        */
        // const params = new URLSearchParams();
        const params = new FormData();
        params.append('date', action.currentDate.format());
        axios.post(CheminComplet, params)
        .then((response) => {
        console.log(response);
          store.dispatch(setActivities(response.data.activities));
        })
        .catch((error) => {
        console.log(error);
        });
        // Je dispatche mon action pour enregistrer ces nouvelles données dans mon
        //  state activités + un dispatch pour enregistrer infos utilisateur
        //

        break;
      }
    case CHANGE_DATE:
        console.info('La date a changer : requete axios pour récupérer les nouvelles données');
        // axios
        // dispatch
      break;
    default:
  }

  next(action);
};


/*
 * Action creator
 */
export const loadActivities = currentDate => ({
  type: LOAD_ACTIVITIES,
  currentDate,
});

/*
 * Export default
 */
export default createMiddleware;

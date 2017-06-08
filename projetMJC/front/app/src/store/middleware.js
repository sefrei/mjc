/*
 * Npm import
 */
import axios from 'axios';
import moment from 'moment';
import 'moment/locale/fr';

/*
 * Local import
 */
import { CHANGE_DATE, UP_DAY, DOWN_DAY, setActivities, state } from './reducer';
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
        // console.error();
        let CheminComplet = document.location.href;
        if (CheminComplet.substr(CheminComplet.length - 1, 1) !== '/') {
          CheminComplet += '/';
        }
        // On fait une requête ajax pour récupérer les infos de l'utilisateur +
        // On fait une requête ajax pour récupérer les activités lié à la date et à (l'utilisateur)
        const newDate = moment().format().split('T');
        CheminComplet += 'planning/' + newDate[0];
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
        console.info(action.currentDate.format());
        const params = new URLSearchParams();
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
    case UP_DAY:
    case DOWN_DAY:
      {
        console.error(action);
        const newDate = action.date.format().split('T');
        console.log(newDate[0]);
        let CheminComplet = document.location.href;
        if (CheminComplet.substr(CheminComplet.length - 1, 1) !== '/') {
          CheminComplet += '/';
        }
        CheminComplet += 'planning/' + newDate[0];
        console.info('La date a changer : requete axios pour récupérer les nouvelles données');
        const params = new URLSearchParams();
        params.append('date', action.date.format());
        axios.post(CheminComplet, params)
        .then((response) => {
        console.log(response);
          store.dispatch(setActivities(response.data.activities));
        })
        .catch((error) => {
        console.log(error);
        });
        // dispatch
        break;
      }
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

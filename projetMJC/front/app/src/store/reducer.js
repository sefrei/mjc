/*
 * Npm Import
 */
import moment from 'moment';
import 'moment/locale/fr';
/*
 * Local import
 */
import datas from 'src/datas';
/*
 * Types
 */
export const CHANGE_DATE = 'CHANGE_DATE';
const SET_ACTIVITIES = 'SET_ACTIVITIES';
const SWITCH_PRESENCE_TEACHER = 'SWITCH_PRESENCE';

/*
 * initialState
 */
const initialState = {
  currentDate: moment(),
  activities: datas,
};


/*
 * Reducer
 */
export default (state = initialState, action = {}) => {
  switch (action.type) {
    case CHANGE_DATE:
      {
        return {
          ...state,
          currentDate: action.date,
        };
      }
    case SET_ACTIVITIES:
      {
        return {
          ...state,
          activities: action.activities,
        };
      }
    case SWITCH_PRESENCE_TEACHER:
      {
        const { id } = action;
        const activities = [...state.activities];
        activities.forEach((activity) => {
          if (activity.id === id) {
            activity.teacher = !activity.teacher;
          }
        });
        return {
          ...state,
          activities,
        };
      }
    default:
      return state;
  }
};

/*
 * Action creators
 */
export const changeDate = (date) => {
  console.log('changeDate');
  return (
  {
    type: CHANGE_DATE,
    date,
  }
  );
};
export const switchPresenceTeacher = (id) => {
  console.log('switchPresenceTeacher');
  return ({
    type: SWITCH_PRESENCE_TEACHER,
    id,
  });
};
export const setActivities = (activities) => {
  console.log('SetActivities');
  return (
  {
    type: SET_ACTIVITIES,
    activities,
  }
  );
};

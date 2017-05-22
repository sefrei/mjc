/*
 * Npm Import
 */
import moment from 'moment';

/*
 * Types
 */
const CHANGE_DATE = 'CHANGE_DATE';
const CHANGE_DAY = 'CHANGE_DAY';
/*
 * initialState
 */
const initialState = {
  currentDate: moment(),
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
    case CHANGE_DAY:
      {
        console.log('CHANGE_DAY');
        const newDate = state.currentDate;
        newDate.add(1, 'days');
        console.log(newDate);
        return {
          ...state,
          currentDate: newDate,
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
  //console.log(date);
  return (
  {
    type: CHANGE_DATE,
    date,
  }
  );
};
export const changeDay = () => {
  //console.log('day');
  return (
  {
    type: CHANGE_DAY,
  }
  );
};

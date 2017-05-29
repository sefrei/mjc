/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import { Link } from 'react-router-dom';
import classNames from 'classnames';

/*
 * Local import
 */
import Presence from 'src/containers/Presence';
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Activity = ({ currentDate, startDate, startHour,  finishDate, finishHour, presenceTeacher, presenceStudent, activity_id: id, observation, actions }) => {

  const onChange = (evt) => {
    const { value } = evt.target;
    actions.changeInputObservation(value);
  };
  const onSubmit = (evt) => {
    evt.preventDefault();
    console.info("Actions : Enregistrer dans la BDD");
    //actions.addTask();
  };

  //const startTime = startDate.split(' ')[1].substr(0, 5);
  //const endTime = endDate.split(' ')[1].substr(0, 5);
  const stateActivity = (!presenceTeacher || !presenceStudent);
  return (
    <div id="activity-view">
      <h1 id="date-title">{currentDate.format('dddd D MMMM YYYY')}</h1>
      <h2 id="activity-title">Activité {id} de {startHour} à {finishHour}</h2>
      <label id="label-observation" htmlFor="observation">Observation :</label>
      <form id="form" onSubmit={onSubmit}>
        <input type="text" onChange={onChange} id="observation" placeholder="Votre observation..." value={observation} />
      </form>
      <button onClick={actions.resetObservation}>Annuler Modification de l'observation</button>
      <Presence teacher={presenceTeacher} id={id} />
      <p>Vous êtes actuellement
        <span
          className={classNames(
            'activity-state',
            { absent: stateActivity },
            { present: !stateActivity },
          )}
        >
          {presenceTeacher ? ' présent ' : ' absent '}
        </span>
        pour ce cours
      </p>
      <p>Le cours est
        <span
          className={classNames(
            'activity-state',
            { absent: stateActivity },
            { present: !stateActivity },
          )}
        >
          {stateActivity ? ' est annulé' : ' n\'est pas annulé'}
        </span>
      </p>


      <Link to="/ProjectMJC/projetMJC/web/app_dev.php" >
        Retour Agenda
      </Link>
    </div>
  );
};

Activity.propTypes = {
  currentDate: PropTypes.object.isRequired,
  startDate: PropTypes.string.isRequired,
  startHour: PropTypes.string.isRequired,
  finishDate: PropTypes.string.isRequired,
  finishHour: PropTypes.string.isRequired,
  activity_id: PropTypes.number.isRequired,
  presenceTeacher: PropTypes.bool.isRequired,
  presenceStudent: PropTypes.bool.isRequired,
  observation: PropTypes.string.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Activity;

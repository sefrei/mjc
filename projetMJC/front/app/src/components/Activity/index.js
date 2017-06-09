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
const Activity = ({
  currentDate, startDate, startHour, finishHour,
  presenceTeacher, presenceStudent, student, teacher, user, speciality,
  activity_id: id, appreciation, actions }) => {
  const onChange = (evt) => {
    const { value } = evt.target;
    actions.changeInputObservation(value);
  };
  const onSubmit = (evt) => {
    evt.preventDefault();
    console.info('Actions : Enregistrer dans la BDD');
    // actions.addTask();
  };
  const presenceType = user.user_role === 'ROLE_STUDENT' ? presenceStudent : presenceTeacher;
  console.log(presenceType);
  const stateActivity = (presenceTeacher && presenceStudent);
  const interlocuteur = user.user_role === 'ROLE_STUDENT' ? teacher : student;
  return (
    <div id="activity-view">
      <h1 id="date-title">{currentDate.format('dddd D MMMM YYYY')}</h1>
      <h2 id="activity-title">Activité {id} : cours de {speciality} de {startHour} à {finishHour} avec {interlocuteur}</h2>
      <div id="observation">
        <label id="observation-label" htmlFor="observation-input">Observation :</label>
        <form id="form" onSubmit={onSubmit}>
          <input type="text" onChange={onChange} id="observation-input" placeholder="Votre observation..." value={appreciation} />
        </form>
        <button className="button-reset-observation" onClick={actions.resetObservation}>
          <i className="fa fa-times" aria-hidden="true"></i><span>Réinitialiser l'observation</span>
        </button>
      </div>
      <div id="infos-presence">
        <p>Vous êtes actuellement
          <span
            className={classNames(
              'activity-state',
              { absent: !presenceType },
              { present: presenceType },
            )}
          >
            {presenceType ? ' présent ' : ' absent '}
          </span>
          pour ce cours
        </p>
        <p>Le cours
          <span
            className={classNames(
              'activity-state',
              { absent: !stateActivity },
              { present: stateActivity },
            )}
          >
            {stateActivity ? ' n\'est pas annulé' : ' est annulé'}
          </span>
        </p>
        <Presence
          presenceTeacher={presenceTeacher}
          presenceStudent={presenceStudent}
          stateActivity={stateActivity} id={id}
        />
      </div>

      <Link className="agenda-home-link" to="/ProjectMJC/projetMJC/web/app_dev.php" >
        Retour Agenda
      </Link>
    </div>
  );
};

Activity.propTypes = {
  currentDate: PropTypes.object.isRequired,
  startDate: PropTypes.string.isRequired,
  startHour: PropTypes.string.isRequired,
  finishHour: PropTypes.string.isRequired,
  activity_id: PropTypes.number.isRequired,
  presenceTeacher: PropTypes.bool.isRequired,
  presenceStudent: PropTypes.bool.isRequired,
  student: PropTypes.string.isRequired,
  speciality: PropTypes.string.isRequired,
  appreciation: PropTypes.string.isRequired,
  teacher: PropTypes.string.isRequired,
  user: PropTypes.object.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
};

/*
 * Export default
 */
export default Activity;

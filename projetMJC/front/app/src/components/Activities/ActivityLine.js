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
const ActivityLine = ({ startDate, startHour, finishHour, activity_id: id,
  speciality, presenceStudent, presenceTeacher, student, teacher, user }) => {
  // Get the state of the activity in depend of the presence of the 2 users (teacher / student).
  const stateActivity = (presenceTeacher && presenceStudent);
  // Get the good name of the second user who doing the activity with the current user,
  // ex: If it's the student then we pick the teacher name.
  const interlocuteur = user.user_role === 'ROLE_STUDENT' ? teacher : student;
  return (
    <div className="activity">
      <div className="activity-hour">{startHour} à {finishHour}</div>
      <Link
        className="activity-link"
        to={`/ProjectMJC/projetMJC/web/app_dev.php/activity/${id}`}
      >
        Cours de {speciality} avec {interlocuteur}
        <button className="show-activity-button">Voir l'activité</button>
      </Link>
      <Presence
        presenceTeacher={presenceTeacher}
        presenceStudent={presenceStudent}
        stateActivity={stateActivity}
        id={id}
      />
    </div>
  );
};

ActivityLine.propTypes = {
  startDate: PropTypes.string.isRequired,
  startHour: PropTypes.string.isRequired,
  finishHour: PropTypes.string.isRequired,
  activity_id: PropTypes.number.isRequired,
  speciality: PropTypes.string.isRequired,
  presenceStudent: PropTypes.bool.isRequired,
  presenceTeacher: PropTypes.bool.isRequired,
  student: PropTypes.string.isRequired,
  teacher: PropTypes.string.isRequired,
  user: PropTypes.object.isRequired,
};

/*
 * Export default
 */
export default ActivityLine;

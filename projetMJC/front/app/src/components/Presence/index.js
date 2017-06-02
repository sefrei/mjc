/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';
import classNames from 'classnames';
/*
 * Local import
 */

 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Presence = ({ presenceTeacher, presenceStudent, actions, stateActivity, user }) => {
  const presenceType = user.type === 'student' ? presenceStudent : presenceTeacher;
  const switchPresenceUser = user.type === 'student' ? actions.switchPresenceStudent : actions.switchPresenceTeacher;
  return (
    <div className="presence">
      {
      (presenceType) ?
          <div onClick={switchPresenceUser} className="one">
            <div className="button-wrap button-active">
              <div className="button-bg">
                <div className="button-out">absent</div>
                <div className="button-in">Présent</div>
                <div className="button-switch"></div>
              </div>
            </div>
          </div>
        :
          <div onClick={switchPresenceUser} className="one">
            <div className="button-wrap">
              <div className="button-bg">
                <div className="button-out">absent</div>
                <div className="button-in">Présent</div>
                <div className="button-switch"></div>
              </div>
            </div>
          </div>
      }
      <div className="activity-statut">
        <span
          className={classNames(
          'activity-state',
          { absent: !stateActivity },
          { present: stateActivity },
        )}
        >
          {stateActivity ? <span className="label label-success">Cours</span> : <span className="label label-danger">Annulé</span>}
        </span>
      </div>
    </div>
  );
};
Presence.propTypes = {
  presenceTeacher: PropTypes.bool.isRequired,
  presenceStudent: PropTypes.bool.isRequired,
  actions: PropTypes.objectOf(PropTypes.func.isRequired).isRequired,
  stateActivity: PropTypes.bool.isRequired,
  user: PropTypes.object.isRequired,
};

/*
 * Export default
 */
export default Presence;

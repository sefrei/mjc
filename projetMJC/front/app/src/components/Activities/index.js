/*
 * Npm import
 */
import React from 'react';
import PropTypes from 'prop-types';

/*
 * Local import
 */
import ActivityLine from 'src/containers/Activities/ActivityLine';
 // CSS Modules, react-datepicker-cssmodules.css


/*
 * Code
 */
const Activities = ({ activities }) => (
  <div id="activities">
    {activities.map(lesson => (
      <ActivityLine key={lesson.activity_id} {...lesson} />
    ))}
  </div>
);

Activities.propTypes = {
  activities: PropTypes.arrayOf(PropTypes.object.isRequired).isRequired,
};

/*
 * Export default
 */
export default Activities;

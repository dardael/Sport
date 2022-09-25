import React from "react";
import Session from "../../../sessions/components/entities/Session";
import {BarChart, Bar, Legend, Tooltip, XAxis, YAxis} from "recharts";
import SessionsFormatter from "../entities/SessionsFormatter";
import SessionType from "../../../settings/sessions/entities/Session";

const ChartSummary:React.FunctionComponent<{
    sessions?: Session[],
    sessionsTypes: SessionType[]
}> = ({
     sessions,
     sessionsTypes,
}) => {
    const sessionsFormatter = new SessionsFormatter(sessions, sessionsTypes);
    const usedSessionsTypes = sessionsFormatter.getSessionsTypes();
    return <>
         <BarChart width={730} height={250} data={sessionsFormatter.getSummedSessionsValuesByExercices()}>
            <XAxis dataKey="name" />
            <YAxis />
            <Tooltip />
            <Legend />
             {usedSessionsTypes.map(sessionType => {
                return <Bar key={sessionType.id} dataKey={sessionType.exercice} fill={sessionType.color}/>
             })}
        </BarChart>
    </>
}

export default ChartSummary;

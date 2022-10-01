import React from "react";
import Session from "../../../sessions/components/entities/Session";
import {BarChart, Bar, Legend, Tooltip, XAxis, YAxis, ResponsiveContainer} from "recharts";
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
        {usedSessionsTypes.map(sessionType => {
            return <ResponsiveContainer key={sessionType.id}>
                <BarChart data={sessionsFormatter.getSessionsOrderedByDate(sessionType.id)}>
                    <XAxis dataKey="date"/>
                    <YAxis/>
                    <Tooltip/>
                    <Legend/>
                    <Bar dataKey={SessionType.getUnitName(sessionType.unit)} fill={sessionType.color}/>
                </BarChart>
            </ResponsiveContainer>
        })}
    </>
}

export default ChartSummary;

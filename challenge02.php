<?php

#Challenge 2

#Answer for question #1
/* 
 * Semua table sudah mengikuti konsep normalisasi, 
 * kecuali table attendee karena akan ada potensi pengulangan data / redundancy attendee
 * Jadi jika disesuaikan dengan konsep normalisasi, maka 2 field (attendee_id dan attendee_name) dipisahkan dari attribut lain. 
 * Dengan kata lain, table attendee dipecah menjadi 2 table dimana salah satu tablenya akan memiliki field tambahan sebagai relasi
 * ke table pasangannya (attendee_id)
 */


#Answer for question 2
/*
 * Table event --> primary key nya adalah event_id
 * Table ticket --> primary key nya adalah ticket_id
 * Table eventticket --> tidak ada field yang menjadi primary key, disarankan untuk menambah field baru sebagai primary key. 
 * Table attendee --> primary key nya adalah attendee_id
 */

#Answer for question 3
/*
 * Table event: diperlukan index di kolom event_name
 * Table eventticket: diperlukan index untuk kolom event_id dan ticket_id
 * Table attendee: diperlukan index untuk kolom attendee_name, event_id, ticket_id 
 */

#Answer for question 4
/*
 * SELECT e.event_name, t.ticket_class, et.ticket_available 
 * FROM event e, ticket t, eventticket et
 * WHERE (et.event_id=e.event_id) AND (et.ticket_id=t.ticket_id) 
 * AND ((et.ticket_price < t.standard_min_price)OR(et.ticket_price > t.standard_max_price))
 */

#Answer for question 5
/*
 * SELECT e.event_name, 
 * SUM((SELECT ticket_price FROM eventticket et WHERE et.event_id=a.event_id AND et.ticket_id=a.ticket_id) * (1+a.num_of_person_going)) AS harga 
 * FROM event e, attendee a 
 * WHERE (a.event_id=e.event_id)AND(a.payment_status='PAID') GROUP BY a.event_id
 */

#Answer for question 6
/*
 * SELECT e.event_name, t.ticket_class 
 * FROM event e, eventticket et, ticket t 
 * WHERE (et.event_id=e.event_id) AND (et.ticket_id=t.ticket_id) AND (et.ticket_available=0)
 */

#Answer for question 7
/*
 * SELECT e.event_name, 
(SELECT SUM(attendee.num_of_person_going+1) FROM attendee, ticket WHERE attendee.ticket_id=ticket.ticket_id AND attendee.event_id=a.event_id AND  ticket.ticket_class='Festival') AS Festival,
(SELECT SUM(attendee.num_of_person_going) FROM attendee, ticket WHERE attendee.ticket_id=ticket.ticket_id AND attendee.event_id=a.event_id AND  ticket.ticket_class='Bronze') AS Bronze,
(SELECT SUM(attendee.num_of_person_going) FROM attendee, ticket WHERE attendee.ticket_id=ticket.ticket_id AND attendee.event_id=a.event_id AND  ticket.ticket_class='Silver') AS Silver,
(SELECT SUM(attendee.num_of_person_going) FROM attendee, ticket WHERE attendee.ticket_id=ticket.ticket_id AND attendee.event_id=a.event_id AND  ticket.ticket_class='Gold') AS Gold,
(SELECT SUM(attendee.num_of_person_going) FROM attendee, ticket WHERE attendee.ticket_id=ticket.ticket_id AND attendee.event_id=a.event_id AND  ticket.ticket_class='Platinum') AS Platinum
FROM event e, attendee a, ticket t
WHERE (a.event_id=e.event_id)AND(a.ticket_id=t.ticket_id)AND(a.payment_status='PAID')
GROUP BY a.event_id
 */

#Answer for question 8
/*
 * Change event date to next year
 * UPDATE event SET event_date=CONCAT(YEAR(event_date)+1, '-', DATE_FORMAT(event_date, '%m-%d'))
 * 
 * Change ticket selling start & end
 * UPDATE eventticket SET 
 * ticket_sell_start=CONCAT(YEAR(ticket_sell_start)+1, '-', DATE_FORMAT(ticket_sell_start, '%m-%d')), 
 * ticket_sell_end=CONCAT(YEAR(ticket_sell_end)+1, '-', DATE_FORMAT(ticket_sell_end, '%m-%d')),
 * ticket_status='Inactive' 
 * WHERE event_id=(SELECT event_id FROM event WHERE event_name='Iwan Fals')
 * 
 * Recalculate the ticket available
 * UPDATE eventticket SET eventticket.ticket_available=ticket_available+(SELECT SUM(attendee.num_of_person_going+1) FROM attendee WHERE attendee.event_id=(SELECT event.event_id FROM event WHERE event.event_name='Iwan Fals') AND attendee.payment_status='PAID')
WHERE eventticket.event_id=(SELECT event.event_id FROM event WHERE event.event_name='Iwan Fals')
 * 
 * Change payment status to cancel
 * UPDATE attendee SET attendee.payment_status='CANCEL' WHERE attendee.event_id=(SELECT event.event_id FROM event WHERE event.event_name='Iwan Fals')
 */